<?php

namespace App\Controllers\Admin;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;
use App\Controllers\Controller;
use App\Models\TableModel;

use Slim\Psr7\Request;

class ReservasController extends Controller
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
        // return $response;
        // $this->guard->removeAllTokenFromStorage();
        return $this->render($response, 'App.Reservas.reservas', [
            'titulo_web' => 'Rservas',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                // 'js/app/plugins/ckeditor/ckeditor.js',
                // 'js/app/sample.js',
                'js/app/reservas.js',
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
        $model->setTable('bib_copias');
        $model->setId("idcopias");

        $arrData = $model->orderBy("idcopias", "DESC")->get();
        // dep([$arrData,count($arrData)],1);
        $data = [];

        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            $libro = $model->query("SELECT lib_titulo FROM bib_libros WHERE idlibro = ?", [$arrData[$i]['idlibro']])->first();
            if ($arrData[$i]['cop_estado'] == 1) {
                $data[$i]['status'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $data[$i]['status'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['idcopias'] . ')" title="Editar Libro"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['idcopias'] . ')" title="Eliminar Libro"><i class="bx bxs-trash-alt" ></i></button>';
            }

            $data[$i]['options'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnEdit . ' ' . $btnDelete . '</div>';
            $data[$i]['num'] = $nmr;
            $data[$i]['name'] = $libro['lib_titulo'];
            $data[$i]['cod'] = $arrData[$i]['cop_codinventario'];
        }
        return $this->respondWithJson($response, $data);
    }

    public function store($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        // return $this->respondWithJson($response, $data);

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $errors = $this->validar($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $model = new TableModel;
        $model->setTable('bib_copias');
        $model->setId("idcopias");

        $data['name'] = empty($data['name']) ? $data['idlibro'] : $data['name'];
        $rq = $model->create([
            "idlibro" => $data['idlibro'] ?? 0,
            "cop_codinventario" => $data['name'],
            "cop_ubicacion" => ucfirst($data['ubicacion']) ?: "UNDEFINED",
            "cop_copias_disponibles" => '1',
            "cop_estado" => 1
        ]);
        if (!empty($rq)) {
            $msg = "Datos guardados correctamente";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $msg);
    }

    public function validar($data)
    {

        if (empty("idlibro")) {
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
        $model->setTable('bib_copias');
        $model->setId("idcopias");

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
        $data = $this->sanitize($request->getParsedBody());
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
        $model->setTable('bib_copias');
        $model->setId("idcopias");

        $data['name'] = $data['name'] ?? $data['idlibro'];
        $rq = $model->update($data['id'], [
            "idlibro" => $data['idlibro'] ?? 0,
            "cop_codinventario" => $data['name'] ?? 0,
            "cop_ubicacion" => ucfirst($data['ubicacion']) ?? "UNDEFINED",
            "cop_copias_disponibles" => '1',
            "cop_estado" => 1
        ]);
        if (!empty($rq)) {
            $msg = "Datos actualizados";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $msg);
    }

    private function validarUpdate($data)
    {
        if (empty("id")) {
            return false;
        }
        if (empty("idlibro")) {
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
        $model->setTable('bib_copias');
        $model->setId("idcopias");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {
            // verificar 
            // $libro = $model->query("SELECT * FROM `bib_libros` WHERE `idarticulo` = {$data["id"]}")->first();

            // if (!empty($libro)) {
            //     $msg = "No se puede eliminar el registro, ya que tiene un libro asociado";
            //     return $this->respondWithError($response, $libro);
            // }

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

    public function libros($request, $response)
    {
        $model = new TableModel;
        $arrData = $model->query("SELECT idlibro as id, lib_titulo as nombre FROM bib_libros ORDER BY idlibro ASC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
    }
}
