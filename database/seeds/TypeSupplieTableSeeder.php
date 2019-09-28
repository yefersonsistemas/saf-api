<?php

use Illuminate\Database\Seeder;
use App\TypeSupplie;

class TypeSupplieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeSupplie::truncate();
        factory(TypeSupplie::class, 20)->create();
    }
}
