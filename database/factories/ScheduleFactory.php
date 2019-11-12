<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Schedule;
use App\Employe;
use App\Branch;

use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'day' => $faker->randomElement(['monday', 'tuesday','wednesday', 'thursday', 'friday']),
        'turn' => $faker->randomElement(['mañana', 'tarde']),
        'quota' => $faker->randomDigit,
        'employe_id' => $employe->id,
        'branch_id' => $branchoffice->id,
    ];
});
