<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(RolesAndPermissionsTablesSeeders::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(SpecialitiesTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(ConsultationTypesTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(DiagnosticsTableSeeder::class);
        // $this->call(SalesTableSeeder::class);
        // $this->call(DiseasesTableSeeder::class);
        // $this->call(MedicinesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
