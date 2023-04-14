<?php

use App\Controllers\Error\ErrorController;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Psr7\Response;

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(
    HttpNotFoundException::class,
    ErrorController::class . ':notFound'
);

$errorMiddleware->setErrorHandler(
    HttpMethodNotAllowedException::class,
    function (ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails) {
        $response = new Response();
        $response->getBody()->write('405 NOT ALLOWED');

        return $response->withStatus(405);
    }
);
