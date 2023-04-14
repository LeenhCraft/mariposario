<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Models\Admin\SubmenuModel;
use App\Models\MenuModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class SubmenusController extends Controller
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
        return $this->render($response, 'App.Submenus.submenus', [
            'titulo_web' => 'Submenus',
            "url" => $request->getUri()->getPath(),
            "permisos" => $this->permisos,
            "js" => ["js/app/nw_submenus.js"],
            "tk" => [
                "name" => $this->guard->getTokenNameKey(),
                "value" => $this->guard->getTokenValueKey(),
                "key" => $this->guard->generateToken()
            ]
        ]);
    }

    public function list($request, $response)
    {
        $model = new SubmenuModel;
        $arrData = $model->query("SELECT * FROM sis_submenus a INNER JOIN sis_menus b ON b.idmenu=a.idmenu ORDER BY a.idsubmenu desc")->get();
        $nmr = 0;
        for ($i = 0; $i < count($arrData); $i++) {
            $btnView = "";
            $btnEdit = "";
            $btnDelete = "";
            $nmr++;
            if ($this->permisos['perm_r'] == 1) {
                $btnView = '<button class="btn btn-info btn-sm" onClick="fntView(' . $arrData[$i]['idsubmenu'] . ')" title="Ver Submenus"><i class="bx bx-show-alt"></i></button>';
            }
            if ($this->permisos['perm_u'] == 1) {
                $btnEdit = '<button class="btn btn-success btn-sm" onClick="fntEdit(' . $arrData[$i]['idsubmenu'] . ')" title="Editar Submenus"><i class="bx bxs-edit-alt"></i></button>';
            }
            if ($this->permisos['perm_d'] == 1) {
                $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDel(' . $arrData[$i]['idsubmenu'] . ')" title="Eliminar Submenus"><i class="bx bxs-trash-alt" ></i></button>';
            }
            if ($arrData[$i]['sub_visible'] == 1) {
                $arrData[$i]['ver'] = "<i class='bx-1 bx bx-check text-success'></i>";
            } else {
                $arrData[$i]['ver'] = "<i class='bx-1 bx bx-x text-danger'></i>";
            }
            $arrData[$i]['options'] = '<div class="btn-group text-center" role="group" aria-label="Basic example">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            $arrData[$i]['menu'] = '<i class="bx ' . $arrData[$i]['men_icono'] . '"></i> ' . ucwords($arrData[$i]['men_nombre']);
            $arrData[$i]['url'] = strtolower($arrData[$i]['sub_url']);
            $arrData[$i]['submenu'] = '<i class="bx ' . $arrData[$i]['sub_icono'] . '"></i> ' . ucfirst($arrData[$i]['sub_nombre']);
            $arrData[$i]['nmr'] = $nmr;
            $arrData[$i]['orden'] = $arrData[$i]['sub_orden'];
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

        $model = new SubmenuModel;
        $existe = $model->where("sub_nombre", "LIKE", $data['name'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un submenu con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->create([
            "idmenu" => $data["idmenu"],
            "sub_nombre" => ucfirst($data["name"]),
            "sub_url" => $data['url'],
            "sub_controlador" => $data['controller'],
            "sub_metodo" => $data['method'],
            "sub_icono" => $data['icon'] ?: "bx-circle",
            "sub_orden" => $data['order'] ?: 1,
            "sub_visible" => $data['visible'] ?: 0,
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
        if (empty($data["idmenu"])) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        if (empty($data["url"])) {
            return false;
        }
        if (empty($data["controller"])) {
            return false;
        }
        if (empty($data["method"])) {
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

        $model = new SubmenuModel;
        $rq = $model->where("idsubmenu", $data["id"])->first();
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

    public function menus($request, $response)
    {
        $menuModel = new MenuModel;
        $arrData = $menuModel->query("SELECT idmenu as id, men_nombre as nombre FROM sis_menus ORDER BY idmenu DESC")->get();
        return $this->respondWithJson($response, ["status" => true, "data" => $arrData]);
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

        $model = new SubmenuModel;
        $existe = $model->where("sub_nombre", "LIKE", $data['name'])->where("idsubmenu", "!=", $data['id'])->first();
        if (!empty($existe)) {
            $msg = "Ya tiene un submenu con el mismo nombre";
            return $this->respondWithError($response, $msg);
        }

        $rq = $model->update($data['id'], [
            "idmenu" => $data["idmenu"],
            "sub_nombre" => ucfirst($data["name"]),
            "sub_url" => $data['url'],
            "sub_controlador" => $data['controller'],
            "sub_metodo" => $data['method'],
            "sub_icono" => $data['icon'] ?: "bx-circle",
            "sub_orden" => $data['order'] ?: 1,
            "sub_visible" => $data['visible'] ?: 0,
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
        if (empty($data["idmenu"])) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        if (empty($data["url"])) {
            return false;
        }
        if (empty($data["controller"])) {
            return false;
        }
        if (empty($data["method"])) {
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

        $model = new SubmenuModel;
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
