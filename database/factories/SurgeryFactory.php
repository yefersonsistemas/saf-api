<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Surgery;
use App\Employe;
use App\Patient;
use App\Area;
use App\TypeSurgery;
use App\Branch;
use App\Hospitalization;
use Faker\Generator as Faker;

$factory->define(Surgery::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $patient = Patient::inRandomOrder()->first();
    $hospitalization = Hospitalization::inRandomOrder()->first();
    $area = Area::inRandomOrder()->first();
    $typesurgery = TypeSurgery::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'date' =>$faker->date,
        'employe_id' =>$employe->id,
        'patient_id' =>$patient->id,
        'area_id' =>$area->id,
        'type_surgery_id' =>$typesurgery->id,
        'hospitalization_id' =>$hospitalization->id,
        'branch_id' => $branchoffice->id,
    ];
});
