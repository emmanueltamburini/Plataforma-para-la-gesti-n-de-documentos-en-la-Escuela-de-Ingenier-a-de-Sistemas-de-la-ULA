<?php

use Faker\Generator as Faker;
use App\Lista;

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


$factory->define(App\User::class, function (Faker $faker) {

    //Carga la lista de estudiantes
    $Students = Lista::read_list(\Config::get('constants.name_of_list_students'));

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

    $student=array_rand($Students);

    return [
        'name' => $faker->name,
        'ID' => $student,
        //'ID' => $nationality. strval($faker->numberBetween(1000000,20000000)),
        'email' => $Students[$student],
        //'email'=> str_replace(array(" ", "'"), '',$faker->unique()->name . $faker->unique()->randomNumber() . "@ula.ve"),
        'area' => $faker->numberBetween(1,4),
    ];
});
