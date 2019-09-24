<?php

use Illuminate\Database\Seeder;
use Surgery;

class SurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Surgery::truncate();
        factory(Surgery::class, 20)->create();
    }
}
