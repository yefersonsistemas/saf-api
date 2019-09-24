<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsTablesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Permission::truncate();

        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'assistant']);
        Permission::create(['name' => 'create diagnostics']);
    }
}
