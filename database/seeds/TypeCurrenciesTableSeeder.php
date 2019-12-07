<?php

use Illuminate\Database\Seeder;
use App\TypeCurrency;

class TypeCurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCurrency::truncate();

        TypeCurrency::create([
            'name'  => 'RD',
            'branch_id' => '1',
        ]);

        TypeCurrency::create([
            'name'  => 'USD',
            'branch_id' => '1',
        ]);

        TypeCurrency::create([
            'name'  => 'EUR',
            'branch_id' => '1',
        ]);
    }
}
