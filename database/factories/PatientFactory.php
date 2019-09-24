<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Patient;
use App\Person;
use App\Employe;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $patient = Patient::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'date'             => $faker->date,
        'history_number'   => $faker->randomDigit,
        'person_id'        => $person->id,
        'gender'           => $faker->randomElement(['Femenino', 'Masculino']),
        'place'            => $faker->sentence,
        'birthdate'        => $faker->date,
        'age'              => $faker->randomNumber,
        'weight'           => $faker->randomNumber,
        'occupation'       => $faker->word,
        'profession'       => $faker->word,
        'previous_surgery' => $faker->sentence,
        'employe_id'       => $employe->id,
        'branchoffice_id'  => $breanchoffice->id,
    ];
});
