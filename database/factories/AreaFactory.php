<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Area;
use App\TypeArea;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    $typeareas = TypeArea::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'status' => $faker->randomElement(['ocupado', 'desocupado']),
        'type_area_id' =>$typeareas->id,
        'branch_id' => $branchoffice->id,
    ];
});
