<?php

use Illuminate\Database\Seeder;
use App\Balance;

class BalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Balance::truncate();
        factory(Balance::class, 20)->create();
    }
}
