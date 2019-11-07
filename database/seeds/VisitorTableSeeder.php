<?php

use Illuminate\Database\Seeder;
use App\Visitor;
use App\Person;
use App\Traits\ImageFactory;

class VisitorTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visitor::truncate();
        $this->deleteDirectory(storage_path('/app/public/visitor'));

        factory(Person::class,5)->create()->each(function ($person) {
            $visitor = factory(Visitor::class)->create([
                'person_id' => $person->id,
            ]);
            $this->to('visitor', $visitor->id, 'App\Visitor');            
        });
;
    }
}
