<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Surgery;
use App\Employe;
use App\Patient;
use App\Area;
use App\TypeSurgery;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Surgery::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $patient = Patient::inRandomOrder()->first();
    $area = Area::inRandomOrder()->first();
    $typesurgery = TypeSurgery::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'date' =>$faker->date,
        'employe_id' =>$employe->id,
        'patient_id' =>$patient->id,
        'area_id' =>$area->id,
        'type_surgery_id' =>$typesurgery->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
