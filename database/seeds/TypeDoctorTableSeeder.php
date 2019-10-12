<?php

use Illuminate\Database\Seeder;
use App\TypeDoctor;

class TypeDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeDoctor::truncate();

        factory(TypeDoctor::class)->create([
            'name'          => 'clase A',
            'comission'     => '0.75',
        ]);

        factory(TypeDoctor::class)->create([
            'name'          => 'clase B',
            'comission'     => '0.75',
        ]);

        factory(TypeDoctor::class)->create([
            'name'          => 'clase C',
            'comission'     => '0.75',
        ]);

        factory(TypeDoctor::class, 20)->create();
    }
}
