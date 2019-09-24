<?php

use Illuminate\Database\Seeder;
use Payment;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();
        factory(Payment::class, 20)->create();
    }
}
