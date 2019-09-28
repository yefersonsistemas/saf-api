<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeEquipment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeEquipment::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});
