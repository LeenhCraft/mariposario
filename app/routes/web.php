<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;

$app->get('/', HomeController::class . ':index');

$app->get('/contacto', ContactController::class . ':index');
