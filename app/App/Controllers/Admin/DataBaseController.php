<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class DataBaseController extends Controller
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
        return $this->render($response, 'App.Maestras.database', [
            'titulo_web' => 'Tipos',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                'js/app/database.js',
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
        $model->setTable('sis_tareas_ejecutables');
        $model->setId("idtarea");

        $existe = $model->where("ta_name", $data['name'])->first();
        if (!empty($existe)) {
            $msg = "Ya existe un registro con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "ta_name" => ucwords($data['name']) ?? "UNDEFINED",
            "ta_description" => ucfirst($data['description']) ?? "UNDEFINED",
            "ta_execute" => $data['execute'] ?? "-",
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
        if (empty($data["name"])) {
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
}
