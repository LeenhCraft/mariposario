<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Controllers\Login\ForgotPasswordController;
use App\Models\UsuarioModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class AccountController extends Controller
{
    protected $responseFactory;

    protected $guard;

    public function __construct()
    {
        // session_start();
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
        $this->guard->setStorageLimit(1);
    }

    public function index($request, $response, $args)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($_SESSION['lnh']);
        // Generate new tokens
        $csrfNameKey = $this->guard->getTokenNameKey();
        $csrfValueKey = $this->guard->getTokenValueKey();
        $keyPair = $this->guard->generateToken();
        return $this->render($response, "Web.User.account", [
            "data" => [
                'title' => 'Mi cuenta',
            ],
            "js" => [
                "js/web/account.js"
            ],
            "tk" => [
                "name" => $csrfNameKey,
                "value" => $csrfValueKey,
                "key" => $keyPair
            ],
            "user" => $usuario,
        ]);
        // $return = $this->view("Web.User.account", [
        //     "data" => [
        //         'title' => 'Mi cuenta',
        //     ],
        //     "js" => [
        //         "js/web/account.js"
        //     ],
        //     "tk" => [
        //         "name" => $csrfNameKey,
        //         "value" => $csrfValueKey,
        //         "key" => $keyPair
        //     ],
        //     "user" => $usuario,
        // ]);
        // $response->getBody()->write($return);
        // return $response;
    }

    public function updateAccount($request, $response, $args)
    {
        $data = $this->sanitize($request->getParsedBody());
        // validar datos
        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }
        unset($data['password'], $data['password_confirmation'], $data['csrf_name'], $data['csrf_value']);
        $errors = $this->validar($data);
        if (!$errors) {
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $usuarioModel = new UsuarioModel();
        $res = $usuarioModel->update($data["id"], [
            "usu_ndoc" => $data['dni'],
            "usu_nombre" => $data['name'],
            "usu_direc" => $data['address'],
            "usu_cel" => $data['phone'],
        ]);

        if (empty($res)) {
            $msg = "Error al actualizar los datos";
            return $this->respondWithError($response, $msg);
        }
        $this->guard->removeAllTokenFromStorage();
        $msg = "Datos actualizados correctamente";
        return $this->respondWithSuccess($response, $msg);
    }

    public function formForgotPassword($request, $response, $args)
    {
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($_SESSION['lnh']);
        $csrfNameKey = $this->guard->getTokenNameKey();
        $csrfValueKey = $this->guard->getTokenValueKey();
        $keyPair = $this->guard->generateToken();
        $return = $this->view("Web.User.changePassword", [
            "data" => [
                'title' => 'Mi cuenta',
            ],
            "js" => [
                "js/web/change_password.js"
            ],
            "tk" => [
                "name" => $csrfNameKey,
                "value" => $csrfValueKey,
                "key" => $keyPair
            ],
            "user" => $usuario,
        ]);
        $response->getBody()->write($return);
        return $response;
    }

    public function changePassword($request, $response, $args)
    {
        $forgot = new ForgotPasswordController();
        return $forgot->forgot($request, $response, $args);
        // return $this->respondWithJson($response, $request->getParsedBody());
    }

    private function validar($data)
    {
        if (empty($data["id"]) || is_int($data["id"])) {
            return false;
        }
        if (empty($data["dni"]) || strlen($data["dni"]) != 8) {
            return false;
        }
        if (empty($data["name"])) {
            return false;
        }
        if (empty($data["phone"])) {
            return false;
        }
        if (empty($data["address"])) {
            return false;
        }
        return true;
    }
}
