<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\TableModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class EditorialesController extends Controller
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
        return $this->render($response, 'App.Articulos.editoriales', [
            'titulo_web' => 'Editoriales',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                // 'js/app/plugins/ckeditor.js',
                'js/app/editoriales.js',
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
        $model->setTable('bib_editoriales');
        $model->setId("ideditorial");

        $arrData = $model->orderBy("ideditorial", "DESC")->get();
        $data = [];

        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = "";
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            // if ($this->permisos['perm_r'] == 1) {
            //     $btnView = '<button class="btn btn-info btn-sm" onClick="fntView(' . $arrData[$i]['idtipo'] . ')" title="Ver Menus"><i class="bx bx-show-alt"></i></button>';
            // }
            if ($arrData[$i]['edi_estado'] == 1) {
                $data[$i]['status'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $data[$i]['status'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['ideditorial'] . ')" title="Editar Menus"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['ideditorial'] . ')" title="Eliminar Menus"><i class="bx bxs-trash-alt" ></i></button>';
            }

            $data[$i]['num'] = $nmr;
            $data[$i]['name'] = $arrData[$i]['edi_nombre'];
            $data[$i]['options'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
        }
        return $this->respondWithJson($response, $data);
    }

    public function store($request, $response, $args)
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
        $model->setTable('bib_editoriales');
        $model->setId("ideditorial");

        $existe = $model->where("edi_nombre", $data['name'])->where("edi_estado", '1')->first();
        if (!empty($existe)) {
            $msg = "Ya existe un registro con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "edi_nombre" => ucfirst($data['name']) ?? "UNDEFINED",
            "edi_descripcion" => $data['description'],
            "edi_estado" => $data['status'] ?? "1",
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
        $model->setTable('bib_editoriales');
        $model->setId("ideditorial");

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
        $model->setTable('bib_editoriales');
        $model->setId("ideditorial");

        $existe = $model->where("edi_nombre", $data['name'])->where("ideditorial", "!=", $data['id'])->where("edi_estado", '1')->first();

        if (!empty($existe)) {
            $msg = "Ya existe un registro con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "edi_nombre" => ucfirst($data['name']) ?? "UNDEFINED",
            "edi_descripcion" => $data['description'],
            "edi_estado" => $data['status'] ?? "1",
        ]);
        if (!empty($rq)) {
            $msg = "Datos actualizados";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithError($response, $msg);
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
        $model->setTable('bib_editoriales');
        $model->setId("ideditorial");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {
            $rq = $model->query("SELECT * FROM `bib_libros` WHERE `ideditorial` = {$data["id"]}")->first();

            if (!empty($rq)) {
                $msg = "No se puede eliminar el registro, porque que tiene libros asociados";
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
