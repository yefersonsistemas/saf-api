<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InputOutput;
use App\Person;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(InputOutput::class, function (Faker $faker) {
    $person = Personb::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    
    return [
        'person_id'  => $person->id,
        'status'  => $faker->randomElement(['input', 'output']),
        'branchoffice_id' => $breanchoffice->id,
    ];
});
