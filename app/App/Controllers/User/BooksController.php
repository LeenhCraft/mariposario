<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

class BooksController extends Controller
{
    public function __construct()
    {
        echo "construct books";
    }

    public function index($request, $response, $args)
    {
        $response->getBody()->write("perfil");
        return $response;
    }
}
