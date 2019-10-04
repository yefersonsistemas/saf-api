<?php

use Illuminate\Database\Seeder;
use App\Exam;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::truncate();

        factory(Exam::class)->create([
            'name'    => 'hematologia',
        ]);

        factory(Exam::class)->create([
            'name'    => 'uroanalisis',
        ]);

        factory(Exam::class)->create([
            'name'    => 'coproanalisis',
        ]);

        factory(Exam::class)->create([
            'name'    => 'vdrl',
        ]);

        factory(Exam::class)->create([
            'name'    => 'hemograma',
        ]);

        factory(Exam::class, 20)->create();
    }
}
