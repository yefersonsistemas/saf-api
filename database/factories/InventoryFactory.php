<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Inventory;
use App\Supplie;
use App\MachineEquipment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    $supplie = Supplie::inRandomOrder()->first();
    $machineequipment = MachineEquipment::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'quantity_Total' => $faker->numberBetween($min = 300, $max = 400),
        'quantity_Available' => $faker->numberBetween($min = 200, $max = 250),
        'quantity_Assigned' => $faker->numberBetween($min = 100, $max = 150),
        'supplie_id' => $supplie->id,
        'machine_equipment_id' => $machineequipment->id,
        'branch_id' => $branchoffice->id,
    ];
});
