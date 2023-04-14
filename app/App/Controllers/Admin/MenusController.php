<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Admin\MenuAdminModel;
use App\Models\MenuModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class MenusController extends Controller
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
        return $this->render($response, 'App.Menus.menus', [
            'titulo_web' => 'Menus',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            "js" => ["js/app/nw_menus.js"],
            "tk" => [
                "name" => $this->guard->getTokenNameKey(),
                "value" => $this->guard->getTokenValueKey(),
                "key" => $this->guard->generateToken()
            ]
        ]);
    }

    public function list($request, $response)
    {
        $model = new MenuAdminModel;
        $arrData = $model->query("SELECT * FROM sis_menus ORDER BY idmenu DESC")->get();
        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = "";
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            if ($this->permisos['perm_r'] == 1) {
                $btnView = '<button class="btn btn-info btn-sm" onClick="fntView(' . $arrData[$i]['idmenu'] . ')" title="Ver Menus"><i class="bx bx-show-alt"></i></button>';
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['idmenu'] . ')" title="Editar Menus"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['idmenu'] . ')" title="Eliminar Menus"><i class="bx bxs-trash-alt" ></i></button>';
            }
            if ($arrData[$i]['men_visible'] == 1) {
                $arrData[$i]['ver'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $arrData[$i]['ver'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }

            $arrData[$i]['options'] = '<div class="btn-group" role="group" aria-label="Basic example">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            $arrData[$i]['nmr'] = $nmr;
            $arrData[$i]['men_nombre'] = '<i class="me-1 bx ' . $arrData[$i]['men_icono'] . '"></i>' . ucwords($arrData[$i]['men_nombre']);
        }
        return $this->respondWithJson($response, $arrData);
    }

    public function store($request, $response, $args)
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

        $model = new MenuAdminModel;
        $existe = $model->where("men_nombre", $data['name'])->first();
        if (!empty($existe)) {
            $msg = "El nombre del menú ya existe";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "men_nombre" => ucfirst($data['name']) ?? "UNDEFINED",
            "men_url" => $data['url'] ?? "#",
            "men_controlador" => $data['controller'] ?? null,
            // "men_icono" => !empty($data['icon']) ? $data['icon'] : "bx-circle",
            "men_icono" => $data['icon'] ?: "bx-circle",
            "men_url_si" => isset($data['url_si']) && $data['url_si'] == "on" ? '1' : "0",
            "men_orden" => $data['order'] ?: '1',
            "men_visible" => $data['visible'] ?: "0"
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
        if (isset($data['url_si']) && $data['url_si'] == "on") {
            if (empty($data["url"])) {
                return false;
            }
            if (empty($data["controller"])) {
                return false;
            }
        }
        if (empty($data["visible"])) {
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

        $model = new MenuAdminModel;
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

        $model = new MenuAdminModel;
        $existe = $model->where("men_nombre", "LIKE", $data['name'])->where("idmenu", "!=", $data['id'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un submenu con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "men_nombre" => ucfirst($data['name']) ?? "UNDEFINED",
            "men_url" => $data['url'] ?? "#",
            "men_controlador" => $data['controller'] ?? null,
            // "men_icono" => !empty($data['icon']) ? $data['icon'] : "bx-circle",
            "men_icono" => $data['icon'] ?: "bx-circle",
            "men_url_si" => isset($data['url_si']) && $data['url_si'] == "on" ? '1' : "0",
            "men_orden" => $data['order'] ?: '1',
            "men_visible" => $data['visible'] ?: "0"
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
        if (isset($data['url_si']) && $data['url_si'] == "on") {
            if (empty($data["url"])) {
                return false;
            }
            if (empty($data["controller"])) {
                return false;
            }
        }
        // if (empty($data["visible"])) {
        //     return false;
        // }
        return true;
    }

    public function delete($request, $response)
    {
        $data = $this->sanitize($request->getParsedBody());
        if (empty($data["id"])) {
            return $this->respondWithError($response, "Error de validación, por favor recargue la página");
        }

        $model = new MenuAdminModel;
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
}
