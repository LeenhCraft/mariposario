<?php

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Response;

class RemoveCsrfMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['app_session'])) {
            $responseFactory = new ResponseFactory();
            $guard = new Guard($responseFactory);
            $guard->removeAllTokenFromStorage();
        }
        $response = $handler->handle($request);
        // $response->getBody()->write('AFTER');
        return $response;
    }
}
