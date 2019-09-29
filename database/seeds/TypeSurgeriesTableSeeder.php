<?php

use Illuminate\Database\Seeder;
use App\Typesurgery;

class TypeSurgeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typesurgery::truncate();
        factory(Typesurgery::class, 10)->create();
    }
}