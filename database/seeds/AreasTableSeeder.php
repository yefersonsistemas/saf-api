<?php

use Illuminate\Database\Seeder;
use Area;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();
        factory(Area::class, 20)->create();
    }
}
