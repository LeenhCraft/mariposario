<?php

namespace App\Controllers\Login;

use App\Controllers\Controller;
use App\Models\UsuarioModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class ForgotPasswordController extends Controller
{
    protected $responseFactory;

    protected $guard;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
        $this->guard->setStorageLimit(1);
    }

    public function index($request, $response, $args)
    {
        $csrfNameKey = $this->guard->getTokenNameKey();
        $csrfValueKey = $this->guard->getTokenValueKey();
        $keyPair = $this->guard->generateToken();
        return $this->render($response, "Web.Login.forgotPassword", [
            "data" => [
                'title' => 'Login',
            ],
            "js" => [
                "js/web/forgot_password.js"
            ],
            "tk" => [
                "name" => $csrfNameKey,
                "value" => $csrfValueKey,
                "key" => $keyPair
            ],
        ]);
    }

    public function forgot($request, $response, $args)
    {
        //obtener datos
        // sanitizar datos
        $data = $this->sanitize($request->getParsedBody());

        // valdiar token
        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        // validar datos
        $errors = $this->validar($data); // validamos el email
        if (!$errors) {
            $msg = "El email ingresado no es válido";
            return $this->respondWithError($response, $msg);
        }
        // actualizar base de datos
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where("usu_usuario", "LIKE", $data["email"])->where("usu_estado", 1)->first();
        if (!empty($usuario)) {
            $token = token(7);
            $usuario = $usuarioModel->update($usuario['idwebusuario'], [
                "usu_token" => $token,
                "usu_expire" => time() + 60 * 60
            ]);
            // enviar correo
            $this->sendEmail([
                "nombre" => $usuario['usu_nombre'],
                "email" => $usuario['usu_usuario'],
                "token" => $usuario['usu_token'],
                "expires" => $usuario['usu_expire'],
            ]);
            $msg = "Se ha enviado un correo a su cuenta de correo electrónico.";
            return $this->respondWithSuccess($response, $msg);
        }
        $this->guard->removeAllTokenFromStorage();
        // responder
        $msg = "El email ingresado no es válido";
        return $this->respondWithError($response, $msg);
    }

    public function reset($request, $response, $args)
    {
        $data = array_merge($request->getQueryParams(), $args);
        // return $this->respondWithSuccess($response, $data);

        $data = $this->sanitize($data);
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where("usu_usuario", "LIKE", $data["email"])->where("usu_estado", 1)->first();
        if (!empty($usuario)) {
            if ($usuario['usu_token'] == $data['token']) {
                if ($usuario['usu_expire'] > time()) {
                    $csrfNameKey = $this->guard->getTokenNameKey();
                    $csrfValueKey = $this->guard->getTokenValueKey();
                    $keyPair = $this->guard->generateToken();
                    return  $this->render($response, "Web.Login.resetPassword", [
                        "data" => [
                            'title' => 'Reset Password',
                        ],
                        "js" => [
                            "js/web/reset_password.js"
                        ],
                        "tk" => [
                            "name" => $csrfNameKey,
                            "value" => $csrfValueKey,
                            "key" => $keyPair
                        ],
                        "email" => $data["email"],
                    ]);
                }
            }
        }
        $msg = "El token ha expirado, por favor vuelva a solicitar el cambio de contraseña";
        return $this->respondWithError($response, $msg);
    }

    public function updatePassword($request, $response, $args)
    {
        //obtener datos
        // sanitizar datos
        $data = $this->sanitize($request->getParsedBody());

        // valdiar token
        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);
        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        // validar datos
        $errors = $this->validatePassword($data);
        if (!$errors) {
            $msg = "El email ingresado no es válido";
            return $this->respondWithError($response, $msg);
        }
        // actualizar base de datos
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->where("usu_usuario", "LIKE", $data["email"])->where("usu_estado", 1)->first();
        if (!empty($usuario)) {
            $usuario = $usuarioModel->update($usuario['idwebusuario'], [
                "usu_pass" => password_hash($data['password'], PASSWORD_DEFAULT),
                "usu_token" => null,
                "usu_expire" => null
            ]);
        }
        $this->guard->removeAllTokenFromStorage();
        // responder
        $msg = "Se ha actualizado su contraseña";
        return $this->respondWithSuccess($response, $msg);
    }

    private function validar($data)
    {
        if (empty($data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            // $errors["email"] = "El campo Email es obligatorio";
            return false;
        }
        return true;
    }

    public function validatePassword($data)
    {
        if (empty($data["password"])) {
            return false;
        }
        if (empty($data["password_confirmation"])) {
            return false;
        }
        if ($data["password"] != $data["password_confirmation"]) {
            return false;
        }
        return true;
    }

    private function sendEmail($data = [])
    // public function sendEmail($request, $response, $args)
    {
        // $data = [
        //     "nombre" => 'matts',
        //     "email" => 'hackingleenh@gmail.com',
        //     "token" => 'usu_token',
        //     "expires" => time()
        // ];

        if (empty($data)) return false;

        $url_recovery = base_url() . 'reset-password/' . $data["token"] .
            '?email=' . $data["email"];
        $dataUsuario = array(
            'nombre' => $data['nombre'],
            'email' => $data["email"],
            'asunto' => "Confirme su dirección de correo electrónico.",
            'url_recovery' => $url_recovery
        );
        $response_email = enviarEmail($dataUsuario, 'forgotPassword.email');
        return $response_email;

        // $response->getBody()->write("{$response_email}");
        // return $response;
    }
}
