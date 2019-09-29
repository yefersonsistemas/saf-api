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
        'quantity_Total' => $faker->randomDigit,
        'quantity_Available' => $faker->randomDigit,
        'quantity_Assigned' => $faker->randomDigit,
        'supplie_id' => $supplie->id,
        'machine_Equipment_id' => $machineequipment->id,
        'branch_id' => $branchoffice->id,
    ];
});
