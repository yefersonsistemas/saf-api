<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TypeSurgery;
use Faker\Generator as Faker;

$factory->define(TypeSurgery::class, function (Faker $faker) {
    return [
        'name' =>$faker->word,
        'duration' =>$faker->randomDigit,
        'cost' =>$faker->randomFloat,
    ];
});
