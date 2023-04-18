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
        return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'] ?? '', $data['csrf_value'] ?? '');
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }


        // obtenemos el nombre del controlador libre de la palabra controller
        $controller = ucfirst(str_replace('controller', '', strtolower($data['controller'])));

        // definimos las rutas de los archivos
        $rtControlador = '../app/App/Controllers/Admin/' . $controller . 'Controller.php';
        $rtModelo = '../app/App/Models/Admin/' . $controller . 'Model.php';
        $rtJavaScript = '/js/app/nw_' . $controller . '.js';
        $rtVista = '../app/resources/views/App/' . $controller . '/' . $controller . '.php';
        $rtModal = '../app/resources/views/App/Template/Modals/mdl' . $controller . '.php';

        $archivos = $this->buscarArchivo($controller, [
            'controlador' => $rtControlador,
            'modelo' => $rtModelo,
            'js' => $rtJavaScript,
            'vista' => $rtVista,
            'modal' => $rtModal
        ]);

        if (!empty($archivos)) {
            return $this->respondWithError($response, $archivos);
        }

        if ($data['execute']) {

            $bd = $this->baseDatos($data['query'], $data['table'], $data['controller']);
            if (!$bd) {
                return $this->respondWithError($response, "La tabla ya existe o no se pudo crear");
            }

            $structure = $this->structureTable($data['query'], $data['table'], $data['controller']);

            return $this->respondWithJson($response, $structure);
            
        }

        // $model = new TableModel;
        // $model->setTable('sis_tareas_ejecutables');
        // $model->setId("idtarea");

        // $existe = $model->where("ta_name", $data['name'])->first();
        // if (!empty($existe)) {
        //     $msg = "Ya existe un registro con el mismo nombre";
        //     return $this->respondWithError($response, $msg);
        // }

        // $rq = $model->create([
        //     "ta_name" => ucwords($data['name']) ?? "UNDEFINED",
        //     "ta_description" => ucfirst($data['description']) ?? "UNDEFINED",
        //     "ta_execute" => $data['execute'] ?? "-",
        // ]);
        // if (!empty($rq)) {
        //     $msg = "Datos guardados correctamente";
        //     return $this->respondWithSuccess($response, $msg);
        // }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $msg);
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

    public function search($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());

        $errors = $this->validarSearch($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $rq = $model->find($data['id']);
        if (!empty($rq)) {
            return $this->respondWithJson($response, ["status" => true, "data" => $rq]);
        }
        $msg = "No se encontraron datos";
        return $this->respondWithError($response, $msg);
    }

    public function validarSearch($data)
    {
        if (empty($data["id"])) {
            return false;
        }
        return true;
    }

    public function update($request, $response)
    {
        // $data = $this->sanitize($request->getParsedBody());
        $data = $request->getParsedBody();
        // return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $errors = $this->validarUpdate($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $existe = $model->where("ta_name", $data['name'])->where("idtarea", "!=", $data['id'])->first();
        if (!empty($existe)) {
            $msg = "Ya existe un registro con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "ta_name" => ucwords($data['name']) ?? "UNDEFINED",
            "ta_description" => ucfirst($data['description']) ?? "UNDEFINED",
            "ta_execute" => $data['execute'] ?? "-",
        ]);
        if (!empty($rq)) {
            $msg = "Datos actualizados";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $existe);
    }

    private function validarUpdate($data)
    {
        if (empty($data["id"])) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        return true;
    }

    public function delete($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        if (empty($data["id"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {
            $rq = $model->delete($data["id"]);
            if (!empty($rq)) {
                $msg = "Datos eliminados correctamente";
                return $this->respondWithSuccess($response, $msg);
            }
            $msg = "Error al eliminar los datos";
            return $this->respondWithError($response, $msg);
        }
        $msg = "No se encontraron datos para eliminar.";
        return $this->respondWithError($response, $msg);
    }

    public function execute($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        if (empty($data["id"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new TableModel;
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {
            $res = $model->multiQuery($rq["ta_execute"]);
            if ($res) {
                $msg = "Datos eliminados correctamente";
                return $this->respondWithSuccess($response, $msg);
            }
            $msg = "Error al eliminar los datos";
            return $this->respondWithError($response, $msg);
        }
        $msg = "No se encontraron datos para eliminar.";
        return $this->respondWithError($response, $msg);
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

    private function baseDatos($query, $tb, $name)
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
            array_push($data, $key['Field']);
        }

        return $data;
    }
}
