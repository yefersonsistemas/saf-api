<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CleaningRecord;
use App\Employe;
use App\Area;
use App\TypeCleaning;
use App\Branch;

use Faker\Generator as Faker;

$factory->define(CleaningRecord::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $area = Area::inRandomOrder()->first();
    $typecleaning = TypeCleaning::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'employe_id'  => $employe->id,
        'area_id'        => $area->id,
        'type_cleaning_id' => $typecleaning->id,
        'branch_id' => $branchoffice->id,
    ];
});
