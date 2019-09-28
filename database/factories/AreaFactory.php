<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Area;
use App\TypeArea;
use App\Branchoffice;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    $typeareas = TypeArea::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'type_area_id' =>$typeareas->id,
        'branch_id' => $branchoffice->id,
    ];
});
