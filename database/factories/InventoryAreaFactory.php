<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\InventoryArea;
use App\Area;
use App\Inventory;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(InventoryArea::class, function (Faker $faker) {
    $inventory = Inventory::inRandomOrder()->first();
    $typearea = Area::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'quantity_Assigned' => $faker->numberBetween($min = 80, $max = 100),
        'quantity_Used' => $faker->numberBetween($min = 50, $max = 80) ,
        'quantity_Available' => $faker->numberBetween($min = 20, $max = 80),
        'area_id' => $typearea->id,
        'inventory_id' =>$inventory->id,
        'branch_id' => $branchoffice->id,
    ];
});
