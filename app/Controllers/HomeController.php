<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Enrolment;
use App\Models\User;
use Exception;
use Faker\Factory;

/**
 * Home Controller
 */
class HomeController
{
    public function index()
    {
        return View::make('home');
    }

    public function seed()
    {
        $user = new User;
        $enrolment = new Enrolment;
        $faker = Factory::create();

        for($i=1;$i<=100;$i++)
        {
            try
            {
                $userId = $user->create($faker->firstName, $faker->lastName);
                $enrolment->create($userId, $faker->numberBetween(1, 20), $faker->numberBetween(1, 3) );
                $enrolment->create($userId, $faker->numberBetween(1, 20), $faker->numberBetween(1, 3) );
                $enrolment->create($userId, $faker->numberBetween(1, 20), $faker->numberBetween(1, 3) );
            }
            catch(Exception $e){}

        }

        echo "Seeded";
    }
}