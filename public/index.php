<?php

use Slim\Factory\AppFactory;

// use Slim\Views\Twig;
// use Slim\Views\TwigMiddleware;
require_once '../app/vendor/autoload.php';
require_once '../app/App/Http/Helpers.php';
require_once '../app/config/database.php';


$app = AppFactory::create();

require_once __DIR__ . '/../app/config/error.php';
 
require_once __DIR__ . '/../app/routes/web.php';


$app->run();
