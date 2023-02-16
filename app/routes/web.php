<?php

use App\Controllers\HomeController;
use App\Controllers\BlogController as Blog;
use App\Controllers\ContactController;

// $app->get('/', 'App\Controllers\HomeController:index');
$app->get('/', HomeController::class . ':index');
// $app->get('/', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//     return $response;
// });

$app->get('/contacto', ContactController::class . ':index');
// $app->get('/blog', Blog::class . ':index');
// $app->get('/blog[/{slug}]', Blog::class . ':show');

//grupo de rutas para el blog
$app->group('/blog', function ($group) {
    $group->get('', Blog::class . ':index');
    $group->get('/{slug}', Blog::class . ':show');
});
