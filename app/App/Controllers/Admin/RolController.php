<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class RolController extends Controller
{
    protected $permisos;
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
        return $this->render($response, 'App.Usuarios.roles', [
            'titulo_web' => 'Roles',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            "js" => ["js/app/nw_rol.js"],
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
        $where = "WHERE rol_estado 1= 1";
        if ($_SESSION['app_id'] == '1') {
            $where = "";
        }
        $arrData = $model->query("SELECT idrol as 'id', rol_nombre as 'name', rol_estado as 'status' FROM `sis_rol` {$where}")->get();

        $nmr = 1;
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['nmr'] = $nmr;
            $nmr++;
            $btnEdit = '';
            $btnDelete = '';

            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $arrData[$i]['status'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($this->permisos['perm_u'] == '1') {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['id'] . ')" title="Editar Autor"><i class="bx bx-pencil"></i></button>';
            } else {
                $btnEdit = '<button class="btn btn-success btn-sm" title="Editar Autor" disabled><i class="bx bx-penceil"></i></button>';
            }
            if ($this->permisos['perm_d'] == '1') {
                $btnDelete = '<button class="btn btn-danger btn-sm" onclick="fntDel(' . $arrData[$i]['id'] . ')" title="Eliminar Autor"><i class="bx bxs-trash-alt"></i></button>';
            } else {
                $btnDelete = '<button class="btn btn-danger btn-sm" title="Eliminar Autor" disabled><i class="bx bxs-trash-alt"></i></button>';
            }
            $arrData[$i]['opciones'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnEdit . ' ' . $btnDelete . '</div>';
        }
        return $this->respondWithJson($response, $arrData);
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
        $model->setTable("sis_rol");
        $model->setId("idrol");

        $existe = $model->where("rol_nombre", "LIKE", $data['name'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un usuario registrado con ese nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "rol_cod" => $data["code"],
            "rol_nombre" => ucwords($data['name']),
            "rol_descripcion" => $data['description'],
            "rol_estado" => $data['status'] ?: 0,
        ]);
        if (!empty($rq)) {
            $msg = "Datos guardados correctamente";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $existe);
    }

    private function validar($data)
    {
        if (empty($data["code"])) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        if ($data["status"] != 0 && $data["status"] != 1) {
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
        $model->setTable("sis_rol");
        $model->setId("idrol");

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
        $model->setTable("sis_rol");
        $model->setId("idrol");

        $existe = $model->where("rol_nombre", "LIKE", $data['name'])->where("idrol", "!=", $data['id'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un usuario registrado con ese nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "rol_cod" => $data["code"],
            "rol_nombre" => ucwords($data['name']),
            "rol_descripcion" => $data['description'],
            "rol_estado" => $data['status'] ?: 0,
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
        if (empty($data["dni"])) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        if (empty($data["email"])) {
            return false;
        }
        if (empty($data["phone"])) {
            return false;
        }
        if (empty($data["address"])) {
            return false;
        }
        if ($data["status"] != 0 && $data["status"] != 1) {
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
        $model->setTable("sis_rol");
        $model->setId("idrol");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {

            $rq = $model->query("SELECT * FROM `sis_usuarios` WHERE `idrol` = {$data["id"]}");

            if (!empty($rq)) {
                $msg = "No se puede eliminar el rol, ya que tiene usuarios asignados.";
                return $this->respondWithError($response, $msg);
            }

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
}
