<?php

use Illuminate\Database\Seeder;
use App\Allergy;

class AllergyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Allergy::truncate();
        factory(Allergy::class, 20)->create();
    }
}
