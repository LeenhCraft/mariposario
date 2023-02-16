<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
    public function index($request,  $response, $args)
    {
        $contactModel = new Contact();
        $return = $this->view("home", [
            "title" => "Home",
            "description" => "Esta es la página home",
            "data" => $contactModel->all()
        ]);
        $response->getBody()->write($return);
        return $response;
    }

}
