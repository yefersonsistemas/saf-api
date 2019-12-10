<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypePayment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypePayment::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->randomElement(['Efectivo', 'Punto_de_Venta', 'Transferencia', 'Seguro']),
        'branch_id' => $branchoffice->id,
    ];
});
