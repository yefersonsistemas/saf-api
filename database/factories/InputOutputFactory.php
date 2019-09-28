<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InputOutput;
use App\Person;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(InputOutput::class, function (Faker $faker) {
    $person = Personb::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    
    return [
        'person_id'  => $person->id,
        'status'  => $faker->randomElement(['input', 'output']),
        'branch_id' => $branchoffice->id,
    ];
});
