<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Equipment;
use App\TypeEquipment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Equipment::class, function (Faker $faker) {
    $typeequipment = TypeEquipment::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'description'  => $faker->sentence,
        'quantity'  => $faker->numberBetween($min = 200, $max = 250),
        'type_equipment_id'  => $typeequipment->id,
        'branch_id' => $branchoffice->id,
    ];
});
