<?php

use Illuminate\Database\Seeder;
use App\Income;

class IncomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Income::truncate();
        factory(Income::class, 20)->create();
    }
}
