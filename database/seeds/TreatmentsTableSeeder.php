<?php

use App\Treatment;
use Illuminate\Database\Seeder;

class TreatmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Treatment::truncate();
        factory(Treatment::class, 20)->create();
    }
}
