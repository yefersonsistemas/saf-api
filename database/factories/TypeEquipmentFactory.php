<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeEquipment;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(TypeEquipment::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
