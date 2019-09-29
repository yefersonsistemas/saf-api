<?php

use Illuminate\Database\Seeder;
use App\TypePayment;

class TypePaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePayment::truncate();
        factory(TypePayment::class, 3)->create();
    }
}
