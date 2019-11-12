<?php

use App\ClassificationSurgery;
use Illuminate\Database\Seeder;

class ClassificationSurgeryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassificationSurgery::truncate();
        factory(ClassificationSurgery::class)->create([
            'name' => 'ambulatoria'
        ]);

        factory(ClassificationSurgery::class)->create([
            'name' => 'hospitalaria'
        ]);
    }
}
