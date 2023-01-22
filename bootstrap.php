<?php

/**
 * Bootstrap app
 */

use App\Core\View;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\ViewNotFoundException;
use Dotenv\Dotenv;

try {
    define('VIEW_PATH', __DIR__ . '/views');

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    require 'router/web.php';
} catch (RouteNotFoundException | ViewNotFoundException $e) {
    View::make('errors/404');
} catch (Exception $e) {
    echo $e->getMessage();
}
