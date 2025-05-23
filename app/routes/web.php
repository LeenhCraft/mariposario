<?php

// use Slim\App;

use App\Controllers\CarritoController;
use Slim\Routing\RouteCollectorProxy;

// Controllers
use App\Controllers\HomeController;
use App\Controllers\Login\ForgotPasswordController;
use App\Controllers\Login\LoginController;
use App\Controllers\Login\RegisterController;
use App\Controllers\Login\verifyController;
use App\Controllers\LogoutController;
use App\Controllers\User\AccountController;
use App\Controllers\WebController;

// Middlewares
use App\Middleware\LoginMiddleware;
use App\Middleware\PermissionMiddleware;
use App\Middleware\RegisterMiddleware;

// $app->get('/', WebController::class . ':index');
$app->redirect('/', '/admin/login', 301);

$app->get('/login', LoginController::class . ':index')->add(new LoginMiddleware());
$app->post('/login', LoginController::class . ':login');
$app->get('/register', RegisterController::class . ':index')->add(new LoginMiddleware());
$app->post('/register', RegisterController::class . ':save');
$app->get('/verify-email/{url}', verifyController::class . ':index');
$app->post('/email/verification-notification', verifyController::class . ':notification');
$app->get('/forgot-password', ForgotPasswordController::class . ':index');
$app->post('/forgot-password', ForgotPasswordController::class . ':forgot');
$app->get('/reset-password/{token}', ForgotPasswordController::class . ':reset');
$app->post('/reset-password', ForgotPasswordController::class . ':updatePassword');

$app->get('/logout', LogoutController::class . ':index');

$app->get('/dni[/{dni}]', HomeController::class . ':dni');

$app->get('/email', RegisterController::class . ':sendEmail');


$app->group('/me', function (RouteCollectorProxy $group) {
    $group->get("", AccountController::class . ':index');
    $group->post("", AccountController::class . ':updateAccount');
    $group->get('/forgot-password', AccountController::class . ':formForgotPassword');
    $group->post('/forgot-password', AccountController::class . ':changePassword');
})->add(new RegisterMiddleware());

// $app->group('/carrito', function (RouteCollectorProxy $group) {
//     $group->get("", CarritoController::class . ':index');

//     $group->post("/add", CarritoController::class . ':agregar');
// });
