<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\TypeArea;
use App\Traits\ImageFactory;

class AreasTableSeeder extends Seeder
{
    use ImageFactory;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();
        $this->deleteDirectory(storage_path('/app/public/area'));

        $type = factory(TypeArea::class)->create([
            'name' => 'Consultorio',
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 1',
            'type_area_id' =>  $type->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 2',
            'type_area_id' =>  $type->id,
        ]);

        // factory(Area::class)->create([
        //     'name'          => 'consultorio 3',
        //     'type_area_id' =>  $type->id,
        // ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 4',
            'type_area_id' =>  $type->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 5',
            'type_area_id' =>  $type->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 6',
            'type_area_id' =>  $type->id,
        ]);

        // factory(Area::class)->create([
        //     'name'          => 'consultorio 7',
        //     'type_area_id' =>  $type->id,
        // ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 8',
            'type_area_id' =>  $type->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 9',
            'type_area_id' =>  $type->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 10',
            'type_area_id' =>  $type->id,
        ]);
        
        $tipo = factory(TypeArea::class)->create([
            'name' => 'Quirofano',
        ]);

        factory(Area::class)->create([
            'name'          => 'Quirofano 1',
            'type_area_id' =>  $tipo->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'Quirofano 2',
            'type_area_id' =>  $tipo->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'Quirofano 3',
            'type_area_id' =>  $tipo->id,
        ]);

        factory(Area::class)->create([
            'name'          => 'Quirofano 4',
            'type_area_id' =>  $tipo->id,
        ]);

        factory(Area::class)->create()->each(function($area)
        {
            $this->to('area', $area->id, 'App\Area');
        });
    }
}

