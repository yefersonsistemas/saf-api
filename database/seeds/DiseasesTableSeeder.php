<?php

use Illuminate\Database\Seeder;
use App\Disease;
use App\Patient;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::truncate();
        factory(Disease::class,20)->create();  
    }
}
