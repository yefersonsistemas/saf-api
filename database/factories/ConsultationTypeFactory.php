<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ConsultationType;
use Faker\Generator as Faker;

$factory->define(ConsultationType::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
    ];
});
