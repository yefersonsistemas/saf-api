<?php

use Illuminate\Database\Seeder;
use App\Visitor;
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

        factory(Visitor::class, 20)->create()->each(function ($visitor) {
            $this->to('visitor', $visitor->id, 'App\Visitor');
        });
;
    }
}
