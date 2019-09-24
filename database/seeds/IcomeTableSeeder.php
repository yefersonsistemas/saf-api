<?php

use Illuminate\Database\Seeder;
use Icome;

class IcomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icome::truncate();
        factory(Icome::class, 20)->create();
    }
}
