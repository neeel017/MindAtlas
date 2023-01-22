<?php

namespace App\Exceptions;

use Exception;

/**
 * fires when View is not found.
 */
class ViewNotFoundException extends Exception
{
    protected $message = '404 Not Found';
}
