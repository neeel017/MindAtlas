<?php

namespace App\Exceptions;

use Exception;

/**
 * fires when route is not found.
 */
class RouteNotFoundException extends Exception
{
    protected $message = '404 Not Found';
}