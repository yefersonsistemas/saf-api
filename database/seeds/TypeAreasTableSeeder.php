<?php

use Illuminate\Database\Seeder;
use TypeArea;

class TypeAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeArea::truncate();
        factory(TypeArea::class, 20)->create();
    }
    }
}
