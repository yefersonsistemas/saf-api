<?php

use Illuminate\Database\Seeder;
use App\Supplie;

class SupplieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplie::truncate();
        factory(Supplie::class, 20)->create();
    }
}
