<?php

namespace App\Controllers\Admin;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

use App\Controllers\Controller;
use App\Models\Admin\LoginAdminmodel;

class LoginAdminController extends Controller
{
    protected $responseFactory;

    protected $guard;

    public function __construct()
    {
        parent::__construct();
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }

    public function index($request, $response)
    {
        return $this->render($response, "App.Login.login", [
            "titulo_web" => "Login",
            "js" => ["js/app/login.js"],
            "tk" => [
                "name" => $this->guard->getTokenNameKey(),
                "value" => $this->guard->getTokenValueKey(),
                "key" => $this->guard->generateToken()
            ]
        ]);
    }

    public function sessionUser($request, $response, $args)
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

        $loginModel = new LoginAdminmodel;
        $userData = $loginModel->getUser('usu_usuario', $data['email']);

        if (empty($userData)) {
            $msg = "El usuario no existe o no es valido";
            return $this->respondWithError($response, $msg);
        }

        if (!password_verify($data["password"], $userData["usu_pass"])) {
            $msg = "La contraseña no es valida";
            return $this->respondWithError($response, $msg);
        }

        if ($userData["usu_estado"] == 0) {
            $msg = "El usuario está desactivado";
            return $this->respondWithError($response, $msg);
        }
        if ($userData["usu_estado"] == 1 && $userData["usu_activo"] == 1) {
            $_SESSION['app_id'] = $userData['idusuario'];
            $_SESSION['app_r'] = $userData['idrol'];
            $_SESSION['app_session'] = true;
            $msg = "Bienvenido!\n" . $userData["per_nombre"];
            $this->guard->removeAllTokenFromStorage();
            return $this->respondWithSuccess($response, $msg);
        }
        $msg = "Erorr inesperado";
        return $this->respondWithError($response, $msg);
    }

    private function validar($data)
    {
        if (empty($data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (empty($data["password"])) {
            return false;
        }
        return true;
    }
}
