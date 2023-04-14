<?php

namespace App\Controllers\Login;

use App\Controllers\Controller;
use App\Models\UsuarioModel;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class RegisterController extends Controller
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
        // Generate new tokens
        $csrfNameKey = $this->guard->getTokenNameKey();
        $csrfValueKey = $this->guard->getTokenValueKey();
        $keyPair = $this->guard->generateToken();

        return $this->render($response,"Web.Login.register", [
            "data" => [
                'title' => 'Register',
            ],
            "js" => ["js/web/register.js", "js/web/resend_email.js"],
            "tk" => [
                "name" => $csrfNameKey,
                "value" => $csrfValueKey,
                "key" => $keyPair
            ],
        ]);
    }

    public function save($request, $response, $args)
    {
        $data = $this->sanitize($request->getParsedBody()); // obtenemos los datos del formulario y sanitizamos los datos

        $validate = $this->guard->validateToken($data['csrf_name'], $data['csrf_value']);

        if (!$validate) {
            $msg = "Error de validación, por favor recargue la página";
            return $this->respondWithError($response, $msg);
        }

        $errors = $this->validar($data); // validamos los datos
        if (!$errors) { // si hay errores
            $msg = "Verifique los datos ingresados";
            return $this->respondWithError($response, $msg);
        }

        $token = token(7); // generamos un token
        $data["token"] = $token; // agregamos el token al array de datos
        $data['expires'] = time() + 24 * 60 * 60; // 24 horas

        $usuarioModel = new UsuarioModel(); // instanciamos el modelo

        $exist = $usuarioModel->where("usu_usuario", "LIKE", $data["email"])->first(); // verificamos si el email ya se encuentra registrado
        if ($exist) {
            $msg = "El email ya se encuentra registrado";
            return $this->respondWithError($response, $msg);
        }

        $rq = $usuarioModel->save($data); // guardamos los datos

        if (!empty($rq)) {
            // enviar email de confirmacion
            $this->sendEmail([
                "nombre" => $rq['usu_nombre'],
                "email" => $rq['usu_usuario'],
                "token" => $rq['usu_token'],
                "expires" => $rq['usu_expire'],
            ]);
            $rq = [
                "status" => true,
                "message" => "Datos guardados correctamente",
                "data" => [
                    "name" => $rq['usu_nombre'],
                    "token" => $rq['usu_token']
                ]
            ];
        } else {
            $rq = [
                "status" => false,
                "message" => "Error al guardar los datos",
            ];
        }

        return $this->respondWithJson($response, $rq);
    }

    private function validar($data)
    {
        // $errors = [];
        if (empty($data["dni"]) || strlen($data["dni"]) != 8) {
            // $errors["dni"] = "El campo DNI es obligatorio";
            return false;
        }
        if (empty($data["name"])) {
            // $errors["name"] = "El campo Nombre es obligatorio";
            return false;
        }
        if (empty($data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            // $errors["email"] = "El campo Email es obligatorio";
            return false;
        }
        if (empty($data["password"])) {
            // $errors["password"] = "El campo Contraseña es obligatorio";
            return false;
        }
        if (empty($data["password_confirmation"])) {
            // $errors["password_confirmation"] = "El campo Confirmar Contraseña es obligatorio";
            return false;
        }
        if ($data["password"] != $data["password_confirmation"]) {
            // $errors["password_confirmation"] = "Las contraseñas no coinciden";
            return false;
        }
        return true;
    }

    public function sendEmail($data = [])
    // public function sendEmail($request, $response, $args)
    {
        // $data = [
        //     "nombre" => 'matts',
        //     "email" => 'hackingleenh@gmail.com',
        //     "token" => 'usu_token',
        //     "expires" => time()
        // ];

        if (empty($data)) return false;

        $url_recovery = base_url() . 'verify-email/' . $data["token"] .
            // '?email=' . $data["email"] .
            '?expires=' . $data["expires"] .
            '&signature=' . generateSignature($data["token"], $data["expires"]);

        $dataUsuario = array(
            'nombre' => $data['nombre'],
            'email' => $data["email"],
            'asunto' => "Confirme su dirección de correo electrónico.",
            'url_recovery' => $url_recovery
        );
        $response_email = enviarEmail($dataUsuario, 'email');
        return $response_email;

        // $response->getBody()->write("{$response_email}");
        // return $response;
    }
}
