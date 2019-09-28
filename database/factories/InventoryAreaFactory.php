<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\InventoryArea;
use App\TypeArea;
use App\Inventory;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(InventoryArea::class, function (Faker $faker) {
    $inventory = Inventory::inRandomOrder()->first();
    $typearea = TypeArea::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'quantity_Assigned' => $faker->randomDigit,
        'quantity_Used' => $faker->randomDigit,
        'quantity_Available' => $faker->randomDigit,
        'type_area_id' => $typearea->id,
        'inventory_id' =>$inventory->id,
        'branch_id' => $branchoffice->id,
    ];
});
