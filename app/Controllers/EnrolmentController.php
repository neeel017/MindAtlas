<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Enrolment;

/**
 * Enrolment Controller
 */
class EnrolmentController
{
    public function index()
    {
        $enrolment = new Enrolment;
        $response = $enrolment->paginate(100);
        View::make('enrolments/index', $response);
    }
}
