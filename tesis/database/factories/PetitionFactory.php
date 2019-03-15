<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(App\Models\Petition::class, function (Faker $faker) {
    $j=$faker->numberBetween(0,1);

    switch ($j){
        case 0:
            $nationality="V";
            $id_fake=strval($faker->randomLetter.$faker->numberBetween(0,999999));
            break;

        case 1:
            $nationality="E";
            $id_fake=strval($faker->randomLetter.$faker->numberBetween(100000000,100000000));
            break;
    }

    return [
        'ID_user' => $nationality. strval($faker->numberBetween(1000000,20000000)),
        'request_type' =>$faker->numberBetween(1,4),
        'confirmation_code' =>str_random(25),
        'status' => 2,
    ];
});
