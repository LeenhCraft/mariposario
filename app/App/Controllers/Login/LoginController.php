<?php

namespace App\Controllers\Login;

use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

use App\Controllers\Controller;
use App\Models\UsuarioModel;

class LoginController extends Controller
{
    protected $responseFactory;

    protected $guard;

    public function __construct()
    {
        session_start();
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }

    public function index($request, $response, $args)
    {
        $csrfNameKey = $this->guard->getTokenNameKey();
        $csrfValueKey = $this->guard->getTokenValueKey();
        $keyPair = $this->guard->generateToken();
        return $this->render($response, "Web.Login.login", [
            "data" => [
                'title' => 'Login',
            ],
            "js" => [
                "js/web/login.js"
            ],
            "tk" => [
                "name" => $csrfNameKey,
                "value" => $csrfValueKey,
                "key" => $keyPair
            ],
        ]);
    }

    public function login($request, $response, $args)
    {
        $data = $this->sanitize($request->getParsedBody());

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);

        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where("usu_usuario", "LIKE", $data["email"])->first();

        if (empty($usuario)) {
            $msg = "El usuario no existe";
            return $this->respondWithError($response, $msg);
        }

        if (!password_verify($data["password"], $usuario["usu_pass"])) {
            $msg = "La contraseña no es valida";
            return $this->respondWithError($response, $msg);
        }

        if ($usuario["usu_estado"] == 0) {
            $msg = "El usuario está desactivado";
            return $this->respondWithError($response, $msg);
        }
        if ($usuario["usu_estado"] == 1 && $usuario["usu_activo"] == 1) {
            $_SESSION['lnh'] = $usuario['idwebusuario'];
            $_SESSION['pe'] = true;
            $msg = "Bienvenido! " . $usuario["usu_nombre"];
            $this->guard->removeAllTokenFromStorage();
            return $this->respondWithSuccess($response, $msg);
            // return $this->respondWithJson($response, ["status" => true, "message" => $msg]);
        }
        $msg = "Erorr inesperado";
        return $this->respondWithError($response, $msg);
    }
}
