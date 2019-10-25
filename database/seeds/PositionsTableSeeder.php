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
        // Position::truncate();

        // factory(Position::class)->create([
        //     'name'    => 'doctor',
        // ]);

        factory(Position::class)->create([
            'name'    => 'mantenimiento',
        ]);

         factory(Position::class, 5)->create();
    }
}
