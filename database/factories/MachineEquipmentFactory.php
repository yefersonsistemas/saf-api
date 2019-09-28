<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MachineEquipment;
use App\TypeEquipment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(MachineEquipment::class, function (Faker $faker) {
    $typeequipment = TypeEquipment::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'description'  => $faker->sentence,
        'type_equipment_id'  => $typeequipment->id,
        'branch_id' => $branchoffice->id,
    ];
});
