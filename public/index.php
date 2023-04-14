<?php

use Slim\Factory\AppFactory;

require_once '../app/vendor/autoload.php';
require_once '../app/App/Http/Helpers.php';
// require_once '../app/config/env.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../app');
$dotenv->load();
$app = AppFactory::create();

require_once __DIR__ . '/../app/config/error.php';

require_once __DIR__ . '/../app/routes/web.php';
require_once __DIR__ . '/../app/routes/admin.php';


$app->run();
