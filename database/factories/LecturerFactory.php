<?php

use Faker\Generator as Faker;

$factory->define(App\Lecturer::class, function (Faker $faker) {
    return [
        'email'=>$faker->unique()->safeEmail,
        'password'=>sha1('kolawole'),
        'first_name'=>$faker->firstName,
        'last_name'=>$faker->lastName,
        'remember_token'=>str_random(60),
    ];
});
