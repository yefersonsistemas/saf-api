<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use App\Headquarter;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    $headquarters = Headquarter::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'length' => $faker->latitude($min = -90, $max = 90),
        'latitude' => $faker->longitude($min = -180, $max = 180),
        'headquarters_id' => $headquarters->id,

    ];
});
