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

        TypePayment::create([
            'name'  => 'Efectivo',
            'branch_id' => '1',
        ]);

        TypePayment::create([
            'name'  => 'Transferencia',
            'branch_id' => '1',
        ]);

        TypePayment::create([
            'name'  => 'Seguro',
            'branch_id' => '1',
        ]);

        TypePayment::create([
            'name'  => 'Punto_de_Venta',
            'branch_id' => '1',
        ]);
    }
}
