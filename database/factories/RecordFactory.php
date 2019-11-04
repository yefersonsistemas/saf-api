<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    $branch = Branch::inRandomOrder()->first();
    return [
        'quantity'       => null,
        'recordable_id'   => null,
        'recordable_type' => null,
        'branch_id'      => $branch->id,
    ];
});
