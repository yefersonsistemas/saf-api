<?php

use Illuminate\Database\Seeder;
use AreaAssigment;

class AreaAssigmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaAssigment::truncate();
        factory(AreaAssigment::class, 20)->create();
    }
}
