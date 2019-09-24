<?php

use Illuminate\Database\Seeder;
use TypeCleaning;

class TypeCleaningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCleaning::truncate();
        factory(TypeCleaning::class, 20)->create();
    }
}
