<?php

namespace App\Controllers;

class Controller
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        codigo_visita();
    }

    public function view($route, $data = [])
    {
        // extract($data); //extrae los datos del array y los convierte en variables
        $route = str_replace(".", "/", $route);
        if (file_exists("../app/resources/views/{$route}.php")) {
            ob_start();
            include_once "../app/resources/views/{$route}.php";
            $content = ob_get_clean();
            return $content;
        } else {
            return "404 el archivo no existe";
        }
    }

    public function redirect($route)
    {
        header("Location: {$route}");
    }

    public function leenh()
    {
        return "ee";
    }

    public function render($response, $route, $data = [])
    {

        $payload = $this->view($route, $data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'text/html')
            ->withStatus(200);
        return $response;
    }

    public function respondWithError($response, $message)
    {
        return $this->respondWithJson($response, ["status" => false, "message" => $message]);
    }

    public function respondWithSuccess($response, $message)
    {
        return $this->respondWithJson($response, ["status" => true, "message" => $message]);
    }

    public function respondWithJson($response, $data)
    {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function sanitize($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = strClean($value);
        }
        return $data;
    }

    public function get_method($cadena)
    {
        $methodName = explode('::', $cadena);
        return end($methodName);
    }

    public function className($cadena)
    {
        $cadena = get_class($cadena);
        $class = explode('\\', $cadena);
        return end($class);
    }
}
