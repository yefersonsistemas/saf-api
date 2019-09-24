<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use App\Employe;
use App\TypeDoctor;
use App\Branchoffice;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $typedoctor = TypeDoctor::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();

    return [
       'employe_id' => $employe->id,
       'type_doctor_id' =>  $typedoctor->id,
       'price' => $faker->randomFloat,
       'branchoffice' =>  $branchoffice->id,
    ];
});
