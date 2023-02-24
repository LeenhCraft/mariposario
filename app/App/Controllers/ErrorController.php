<?php

namespace App\Controllers;

use Slim\Psr7\Response;

class ErrorController
{
    public function notFound($resquest, $exception, $displayErrorDetails)
    {
        $response = new Response();
        $response->getBody()->write("404 :p");
        return $response->withStatus(404);
    }
}
