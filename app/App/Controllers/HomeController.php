<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
    public function index($request,  $response, $args)
    {
        $return = $this->view("home", [
            "title" => "Home",
            "description" => "Esta es la página home"
        ]);
        $response->getBody()->write($return);
        return $response;
    }

    public function dni($request,  $response, $args)
    {

        // $dni = $args['dni'] ?? '0';
        // dep([$args,$_GET]);
        // $response->getBody()->write(consultaDNI($dni));
        // $token = bin2hex(random_bytes(32));
        $response->getBody()->write("asd");
        return $response;
        // ->withHeader('Content-Type', 'application/json');
    }

    public function account($request,  $response, $args)
    {
        $response->getBody()->write("perfil");
        return $response;
    }
}
