<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'question'=>$faker->sentence(20),
        'a'=>$faker->sentence(5),
        'b'=>$faker->sentence(5),
        'c'=>$faker->sentence(5),
        'd'=>$faker->sentence(5),
        'correct_option'=>$faker->randomElement(['a','b','c','d']),
        'course_id'=>1,
    ];
});
