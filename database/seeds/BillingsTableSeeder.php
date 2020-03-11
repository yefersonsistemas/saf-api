<?php

use Illuminate\Database\Seeder;
use App\Billing;

class BillingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Billing::truncate();
        // factory(Billing::class, 20)->create();
    }
}
