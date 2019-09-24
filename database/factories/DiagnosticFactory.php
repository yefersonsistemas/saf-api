<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Diagnostic;
use App\Patient;
use App\Employe;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Diagnostic::class, function (Faker $faker) {
    $patient = Patient::inRandomOrder()->first();
    $employe = Employe::role('doctor')->inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();

    return [
        'patient_id'  => $patient->id,
        'description' => $faker->sentence(8),
        'reason'      => $faker->sentence(5),
        'treatment'   => $faker->paragraph,
        'annex'       => $faker->paragraph,
        'next_cite'   => $faker->date,
        'employe_id'  => $employe->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
