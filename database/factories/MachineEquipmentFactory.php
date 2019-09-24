<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MachineEquipment;
use App\TypeEquipment;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(MachineEquipment::class, function (Faker $faker) {
    $typeequipment = TypeEquipment::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'description'  => $faker->sentence,
        'type_equipment_id'  => $typeequipment->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
