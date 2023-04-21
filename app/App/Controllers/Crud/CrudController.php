<?php

namespace App\Controllers\Crud;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

use App\Controllers\Controller;

use App\Models\TableModel;

class CrudController extends Controller
{

    protected $permisos = [];
    protected $responseFactory;
    protected $guard;

    public function __construct()
    {
        parent::__construct();
        $this->permisos = getPermisos($this->className($this));
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }

    public function index($request, $response)
    {
        return $this->render($response, 'Crud.crud', [
            'titulo_web' => 'Crud',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                'js/app/plugins/autosize.min.js',
                'js/app/nw_crud.js',
            ],
            "tk" => [
                "name" => $this->guard->getTokenNameKey(),
                "value" => $this->guard->getTokenValueKey(),
                "key" => $this->guard->generateToken()
            ]
        ]);
    }

    public function list($request, $response)
    {
        $model = new TableModel;
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $arrData = $model->orderBy("idtarea", "DESC")->get();
        $data = [];

        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnDelete = "";
            $btnEdit = "";
            $nmr++;

            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<a class="dropdown-item" href="javascript:fntDel(' . $arrData[$i]['idtarea'] . ');"><i class="bx bx-trash me-1"></i> Delete</a>';
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<a class="dropdown-item" href="javascript:fntEdit(' . $arrData[$i]['idtarea'] . ');"><i class="bx bx-edit-alt me-1"></i> Edit</a>';
            }
            $btnTodo = '<button class="btn btn-outline-success btn-sm" onClick="todo(' . $arrData[$i]['idtarea'] . ')" title="Ejecutar"><i class="bx bx-code-alt" ></i></button>';

            $data[$i]['options'] = '<div class="d-flex flex-row">' . $btnTodo . '<div class="ms-3 dropdown"><button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu">' . $btnEdit . $btnDelete . '</div></div></div>';
            $data[$i]['name'] = $arrData[$i]['ta_name'];
            $data[$i]['des'] = $arrData[$i]['ta_description'];
        }
        return $this->respondWithJson($response, $data);
    }

    public function store($request, $response, $args)
    {
        // $data = $this->sanitize($request->getParsedBody());
        $data = $request->getParsedBody();
        $data = array_merge([
            "execute" => '0',
            "replace_file" => '0',
            "create_controller" => '0',
            "create_model" => '0',
            "create_view" => '0',
            "create_js" => '0'
        ], $data);
        // return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'] ?? '', $data['csrf_value'] ?? '');
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }


        // obtenemos el nombre del controlador libre de la palabra controller
        $controller = ucfirst(str_replace('controller', '', strtolower($data['controller'])));

        // definimos las rutas de los archivos
        $pathController = '../app/App/Controllers/Admin/' . $controller . 'Controller.php';
        $pathModel = '../app/App/Models/Admin/' . $controller . 'Model.php';
        $pathJs = 'js/app/nw_' . strtolower($controller) . '.js';
        $pathDirView = '../app/resources/views/App/' . $controller . '/';
        $pathView = '../app/resources/views/App/' . $controller . '/' . strtolower($controller) . '.php';
        $pathModal = '../app/resources/views/App/Template/Modals/mdl' . $controller . '.php';

        // buscamos si los archivos existen
        if (!$data["replace_file"]) { // si no se va a reemplazar los archivos
            $archivos = $this->buscarArchivo($controller, [
                'controlador' => $pathController,
                'modelo' => $pathModel,
                'js' => $pathJs,
                'vista' => $pathView,
                'modal' => $pathModal
            ]);

            if (!empty($archivos)) {
                return $this->respondWithError($response, $archivos);
            }
        }

        // creamos la estructura de la tabla
        if ($data['execute']) {
            $bd = $this->executeQuery($data['query'], $data['table'], $data['controller']);
            if (!$bd) {
                return $this->respondWithError($response, "La tabla ya existe o no se pudo crear");
            }
        }

        // obtenemos la estructura de la tabla
        $structure = $this->structureTable($data['query'], $data['table'], $data['controller']);
        if (empty($structure)) {
            return $this->respondWithError($response, "La tabla ´{$data['table']}´ no existe.");
        }

        $msg = "<ul>";
        if ($data['create_controller']) {
            $contentController = $this->createController($pathController, $controller, $structure, $data['table']);
            $msg .= $this->createFile($contentController, $pathController);
        }

        if ($data['create_view']) {
            // modal
            $contentModal = $this->createModal($pathModal, $controller, $structure, $data['table']);
            $msg .= $this->createFile($contentModal, $pathModal);
            // vista
            $contentView = $this->createView($pathView, $controller, $structure, $data['table']);
            $msg .= $this->createFile($contentView, $pathView, $pathDirView);
        }

        if ($data['create_js']) {
            $contentJs = $this->createJS($pathJs, $controller, $structure, $data['table']);
            $msg .= $this->createFile($contentJs, $pathJs);
        }
        $msg .= "</ul>";
        return $this->respondWithError($response, $msg);
    }

    private function validar($data)
    {
        if (empty($data["controller"])) {
            return false;
        }
        if (empty($data["table"])) {
            return false;
        }
        return true;
    }

    private function buscarArchivo($archivo, $rutas)
    {
        $claves = array_keys($rutas);
        $return = $message = '';
        foreach ($claves as $clave) {
            if (file_exists($rutas[$clave])) {
                // $return[] = $clave;
                $return .= $clave . ',';
            }
        }
        if (!empty($return)) {
            // elimina la ultima coma de $return
            $return = substr($return, 0, -1);
            $message = "El archivo `$archivo` ya tiene creado `$return`";
        }
        return $message;
    }

    private function executeQuery($query, $tb, $name)
    {
        $model = new TableModel;
        $request = $model->multiQuery($query);
        return $request;
    }

    private function structureTable($query, $tb, $name)
    {
        $model = new TableModel;

        $data = [];

        $model->setTable('crud_modulo');
        $model->setId("idmod");

        $model->create([
            "mod_nombre" => ucwords($name),
            "mod_descripcion" => $query,
            "mod_estado" => 1,
        ]);

        $columnTable = $model->query("SHOW COLUMNS FROM $tb")->get();

        foreach ($columnTable as $key) {
            if (empty($key['Field'])) {
                break;
            }
            $data[] = $key['Field'];
        }

        return $data;
    }

    private function createController($ruta, $name, $estructura, $nombreTabla)
    {
        $createController = new CrudCreateController($ruta, $name, $estructura, $nombreTabla);
        return $createController->getBody();
    }

    private function createModal($ruta, $name, $estructura, $nombreTabla)
    {
        $createController = new CrudCreateView($ruta, $name, $estructura, $nombreTabla);
        return $createController->modal();
    }

    private function createView($ruta, $name, $estructura, $nombreTabla)
    {
        $createController = new CrudCreateView($ruta, $name, $estructura, $nombreTabla);
        return $createController->body();
    }

    private function createJs($ruta, $name, $estructura, $nombreTabla)
    {
        $createController = new CrudCreateView($ruta, $name, $estructura, $nombreTabla);
        return $createController->js();
    }

    private function createFile($content, $archivo, $carpeta = null)
    {
        // Creamos la carpeta
        if (!file_exists($carpeta) && !empty($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $path = $archivo;

        $archivo_abierto = fopen($path, 'w');
        if ($archivo_abierto) {
            fwrite($archivo_abierto, $content);
            fclose($archivo_abierto);
        }
        return $archivo_abierto ? "<li>Archivo creado correctamente:</li><li>$archivo</li>" : "<li>No se pudo crear el archivo</li><li>$archivo</li>";
    }
}
