<?php

use Illuminate\Database\Seeder;
use App\Position;

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

        factory(Position::class)->create([
            'name'    => 'doctor',
        ]);

        factory(Position::class, 10)->create();
    }
}
