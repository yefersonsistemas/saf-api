<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Branch;
use App\Employe;
use App\Medicine;
use App\Patient;
use App\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    $patient = Patient::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'patient_id' => $patient->id,
        'employe_id' => $employe->id,
        'branch_id' =>  $branchoffice->id,
    ];
});
