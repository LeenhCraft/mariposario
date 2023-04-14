<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Slim\Csrf\Guard;
use Slim\Psr7\Factory\ResponseFactory;

class DashboardController extends Controller
{
    protected $permisos = [];
    protected $responseFactory;
    protected $guard;

    public function __construct()
    {
        parent::__construct();
        $this->permisos = getPermisos($this->className($this));
        $this->responseFactory = new ResponseFactory();
        $this->guard = new Guard($this->responseFactory);
    }

    public function index($request, $response, $args)
    {
        // return $response;
        $this->guard->removeAllTokenFromStorage();
        return $this->render($response, 'App.Dashboard.dashboard', [
            'titulo_web' => 'Dashboard',
            "url" => $request->getUri()->getPath()
        ]);
    }
}
