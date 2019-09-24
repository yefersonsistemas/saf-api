<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Inventory;
use App\TypeProduct;
use App\Supplie;
use App\MachineEquipment;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Inventory::class, function (Faker $faker) {
    $typeproduct = TypeProduct::inRandomOrder()->first();
    $supplie = Supplie::inRandomOrder()->first();
    $machineequipment = MachineEquipment::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'quantity_Total' => $faker->randomDigit,
        'quantity_Available' => $faker->randomDigit,
        'quantity_Assigned' => $faker->randomDigit,
        'supplie_id' => $supplie->id,
        'machine_Equipment_id' => $machineequipment->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
