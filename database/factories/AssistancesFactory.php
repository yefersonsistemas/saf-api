<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assistance;
use App\Branch;
use App\Employe;
use Faker\Generator as Faker;

$factory->define(Assistance::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'employe_id' => $employe->id,
        'status' => null,
        'branch_id' => $branchoffice->id,
    ];
});
