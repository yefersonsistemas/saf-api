<?php

use App\Hospitalization;
use Illuminate\Database\Seeder;

class HospitalizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hospitalization::truncate();
        factory(Hospitalization::class, 5)->create();
    }
}
