<?php

use Illuminate\Database\Seeder;
use App\Medicine;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicine::truncate();
        factory(Medicine::class, 20)->create();
    }
}
