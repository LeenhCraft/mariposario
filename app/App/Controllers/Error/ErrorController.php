<?php

namespace App\Controllers\Error;

use App\Controllers\Controller;
use Slim\Psr7\Response;

class ErrorController extends Controller
{
    public function notFound($resquest, $exception, $displayErrorDetails)
    {
        $response = new Response();
        $response->getBody()->write("404 :p");
        return $response->withStatus(404);
    }
}
