<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Image;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    $branch = Branch::inRandomOrder()->first();
    return [
        'path'           => null,
        'imageable_id'   => null,
        'imageable_type' => null,
        'branch_id'      => $branch->id,
    ];
});
