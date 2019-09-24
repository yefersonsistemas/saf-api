<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CleaningRecord;
use App\Employe;
use App\Area;
use App\TypeCleaning;
use App\BranchOffice;

use Faker\Generator as Faker;

$factory->define(CleaningRecord::class, function (Faker $faker) {
    $employe = Employe::role('doctor')->inRandomOrder()->first();
    $area = Area::inRandomOrder()->first();
    $typecleaning = TypeCleaning::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();

    return [
        'employe_id'  => $employe->id,
        'area'        => $area->id,
        'type_cleaning_id' => $typecleaning->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
