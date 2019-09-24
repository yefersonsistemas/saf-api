<?php

use Illuminate\Database\Seeder;
use Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::truncate();
        factory(Position::class, 10)->create();
    }
}
