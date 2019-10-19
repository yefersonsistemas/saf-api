<?php

use Illuminate\Database\Seeder;
use App\TypeArea;
use App\Traits\ImageFactory;


class TypeAreasTableSeeder extends Seeder
{
    use ImageFactory;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeArea::truncate();
        $this->deleteDirectory(storage_path('/app/public/typearea'));

        factory(TypeArea::class, 2)->create()->each(function($type){
            $this->to('typearea', $type->id, 'App\TypeArea');
        });

        factory(TypeArea::class)->create([
            'name'     => 'Consultorio',
        ]);
    }
}
