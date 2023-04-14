<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\MenuModel;
use App\Models\TableModel;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ArticulosController extends Controller
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
        return $this->render($response, 'App.Articulos.articulos', [
            'titulo_web' => 'Articulos',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            'js' => [
                'js/app/plugins/ckeditor/ckeditor.js',
                'js/app/sample.js',
                'js/app/articulos.js',
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
        $model->setTable('bib_articulos');
        $model->setId("idarticulo");

        $arrData = $model->orderBy("idarticulo", "DESC")->get();
        $data = [];

        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            if ($arrData[$i]['art_estado'] == 1) {
                $data[$i]['status'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $data[$i]['status'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['idarticulo'] . ')" title="Editar Menus"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['idarticulo'] . ')" title="Eliminar Menus"><i class="bx bxs-trash-alt" ></i></button>';
            }
            $data[$i]['type'] = $model->query("SELECT tip_nombre FROM bib_tipo_articulo WHERE idtipo = " . $arrData[$i]['idtipo'] . " AND tip_estado = 1")->first()['tip_nombre'];

            $data[$i]['options'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnEdit . ' ' . $btnDelete . '</div>';
            $data[$i]['num'] = $nmr;
            $data[$i]['name'] = $arrData[$i]['art_nombre'];
        }
        return $this->respondWithJson($response, $data);
    }

    public function store(Request $request, Response $response)
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
        $model->setTable("bib_articulos");
        $model->setId("idarticulo");

        $existe = $model->where("art_nombre", $data['name'])->where("art_estado", '1')->first();
        if (!empty($existe)) {
            $msg = "Ya existe un articulo con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "idtipo" => $data['type_article'] ?? 0,
            "art_nombre" => ucwords($data['name']) ?? "UNDEFINED",
            "art_num_inventario" => $data['stock_number'] ?? 0,
            "art_descripcion" => $data['description'] ?? null,
            "art_estado" => isset($data['status']) && $data['status'] == "on" ? '1' : "0",
        ]);
        if (!empty($rq)) {
            $msg = "Datos guardados correctamente";
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Error al guardar los datos";
        return $this->respondWithJson($response, $existe);
    }

    public function validar($data)
    {

        if (empty("type_article")) {
            return false;
        }
        if (empty("name")) {
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
        $model->setTable("bib_articulos");
        $model->setId("idarticulo");

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
        $model->setTable("bib_articulos");
        $model->setId("idarticulo");

        $existe = $model->where("art_nombre", $data['name'])->where("idarticulo", "!=", $data['id'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un articulo con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "idtipo" => $data['type_article'] ?? 0,
            "art_nombre" => ucwords($data['name']) ?? "UNDEFINED",
            "art_num_inventario" => $data['stock_number'] ?? 0,
            "art_descripcion" => $data['description'] ?? null,
            "art_estado" => isset($data['status']) && $data['status'] == "on" ? '1' : "0",
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
        if (empty("type_article")) {
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
        $model->setTable("bib_articulos");
        $model->setId("idarticulo");

        $rq = $model->find($data["id"]);
        if (!empty($rq)) {

            $libro = $model->query("SELECT * FROM `bib_libros` WHERE `idarticulo` = {$data["id"]}")->first();

            if (!empty($libro)) {
                $msg = "No se puede eliminar el registro, ya que tiene un libro asociado";
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

    public function tipos($request, $response)
    {
        $menuModel = new MenuModel;
        $arrData = $menuModel->query("SELECT idtipo as id, tip_nombre as nombre FROM bib_tipo_articulo WHERE tip_estado = 1 ORDER BY idtipo ASC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
    }
}
