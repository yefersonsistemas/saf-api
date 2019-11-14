<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Budget;
use App\Procedure;
use App\Hospitalization;
use App\Employe;
use App\Equipment;
use App\Surgery;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Budget::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $procedure = Procedure::inRandomOrder()->first();
    $surgery = Surgery::inRandomOrder()->first();
    $hospitalization = Hospitalization::inRandomOrder()->first();
    $equipment = Equipment::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'employe_id' => $employe->id,
        'surgery_id' => $surgery->id,
        'procedure_id' => $procedure->id,
        'hospitalization_id' => $hospitalization->id,
        'equipment_id' => $equipment->id,
        'branch_id' => $branchoffice->id,
    ];
});
