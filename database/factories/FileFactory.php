<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\File;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    $branch = Branch::inRandomOrder()->first();
    return [
        'path'           => null,
        'fileable_id'   => null,
        'fileable_type' => null,
        'branch_id'      => $branch->id,
    ];
});
