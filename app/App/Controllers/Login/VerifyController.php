<?php

namespace App\Controllers\Login;

use App\Controllers\Controller;
use App\Models\UsuarioModel;

class verifyController extends Controller
{
    public function index($request, $response, $args)
    {
        $token = $args['url'];
        // $expires = $_GET['expires'];
        // $signature = $_GET['signature'];
        $usuarioModel = new UsuarioModel();
        $dataUsuario = $usuarioModel->usaurioToken($token);

        if (empty($dataUsuario)) {
            $msg = "El token no es valido";
            return $this->respondWithError($response, $msg);
        }
        // dep(time() - $dataUsuario["usu_expire"]);
        if (time() - $dataUsuario["usu_expire"] > 0) { // si el token ha expirado
            return $this->render("Web.resendEmail", [
                "data" => [
                    'title' => 'Resend Email',
                ],
                "js" => ["js/web/resend_email.js"],
                "name" => $dataUsuario["usu_nombre"],
                "token" => $dataUsuario["usu_token"],
                "expires" => $dataUsuario["usu_expire"],
            ]);
        }


        $usuarioModel->update($dataUsuario["idwebusuario"], [
            "usu_token" => null,
        ]);

        $usuarioModel->update($dataUsuario["idwebusuario"], [
            "usu_expire" => null,
        ]);

        $usuarioModel->update($dataUsuario["idwebusuario"], [
            "usu_estado" => 1,
        ]);

        $usuarioModel->update($dataUsuario["idwebusuario"], [
            "usu_factivo" => date("Y-m-d H:i:s"),
        ]);

        $_SESSION['lnh'] = $dataUsuario['idwebusuario'];
        $_SESSION['pe'] = true;


        return $response
            ->withHeader('Location', base_url())
            ->withStatus(302);
    }

    public function notification($request, $response, $args)
    {
        $registerController = new RegisterController();
        $usuarioModel = new UsuarioModel();
        $data = $registerController->sanitize($request->getParsedBody()); // obtenemos los datos del formulario y sanitizamos los datos

        // $usuario = $usuarioModel->where("usu_token", "LIKE", $data["_token"] ?? "#")->first();
        $usuario = $usuarioModel->usaurioToken($data['_token'] ?? "#");
        if (empty($usuario)) { // si el token no es valido
            $msg = "El token no es valido";
            return $this->respondWithError($response, $msg);
        }

        // generar nuevo token y time, luego actualizar en la base de datos
        $token = token(7); // generamos un token
        $expires = time() + 24 * 60; // 24 horas

        $rq = $usuarioModel->update($usuario["idwebusuario"], [
            "usu_token" => $token,
            "usu_expire" => $expires,
        ]);

        if (empty($rq)) {
            $msg = "Error al actualizar el token";
            return $this->respondWithError($response, $msg);
        }


        $requestSendEmail = $registerController->sendEmail([
            "nombre" => $rq['usu_nombre'],
            "email" => $rq['usu_usuario'],
            "token" => $rq['usu_token'],
            "expires" => $rq['usu_expire'],
        ]);

        if (!$requestSendEmail) {
            $msg = "Error al enviar el email";
            return $this->respondWithError($response, $msg);
        }

        $msg = "Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó durante el registro";
        return $this->respondWithJson($response, ["status" => true, "message" => $msg, "tk" => $rq['usu_token']]);
    }
}
