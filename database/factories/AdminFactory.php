<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'username'=>'kollybright',
        'password'=>sha1('kolawole1')

    ];
});
