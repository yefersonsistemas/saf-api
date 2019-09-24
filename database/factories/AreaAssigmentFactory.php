<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AreaAssigment;
use App\Employe;
use App\Area;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(AreaAssigment::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $area = Area::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'employe_id'      => $employe->id,
        'area_id'         => $area->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
