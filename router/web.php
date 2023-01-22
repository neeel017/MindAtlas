<?php
/**
 * Routing declaration
 */

use App\Controllers\EnrolmentController;
use App\Controllers\HomeController;

$router = new \App\Core\Router();

$router->get('/', [HomeController::class, 'index'])
    ->get('/seed', [HomeController::class, 'seed'])
    ->get('/enrolments', [EnrolmentController::class, 'index']);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
