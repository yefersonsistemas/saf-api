<?php

use Illuminate\Database\Seeder;
use App\Speciality;

class SpecialitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::truncate();
        factory(Speciality::class, 20)->create();
    }
}
