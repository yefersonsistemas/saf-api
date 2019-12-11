<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class RolesAndPermissionsTablesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        Role::truncate();
        Permission::truncate();

        //Roles de usuarios
        //$role = Role::create(['name' => 'administrador']); por si existira
        Role::create(['name' => 'director']);
        Role::create(['name' => 'seguridad']);
        Role::create(['name' => 'recepcion']);
        Role::create(['name' => 'IN']);
        Role::create(['name' => 'OUT']);
        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'logistica']);
        Role::create(['name' => 'administracion']);
        Role::create(['name' => 'user']);
       
        //Permisos del rol seguridad
        Permission::create(['name' => 'Registrar visitantes']);
        Permission::create(['name' => 'Ver lista de visitantes']);
       

        //Permisos  del rol recepcion
        Permission::create(['name' => 'ver lista de pacientes']);
        Permission::create(['name' => 'crear cita']);

        //Permisos  del rol in
        Permission::create(['name' => 'asignar consultorio']);

        //Permisos  del rol out
        Permission::create(['name' => 'crear factura']);
        Permission::create(['name' => 'Recibir notificacion de paciente candidato a cirugia']);
        
        //Permisos  del rol doctor
        Permission::create(['name' => 'crear historia de paciente']);
        Permission::create(['name' => 'crear diagnostico']);
        Permission::create(['name' => 'elegir examenes a realizar']);
        Permission::create(['name' => 'elegir procedimientos a realizar']);
        Permission::create(['name' => 'crear recipe']);
        Permission::create(['name' => 'ver historial de pacientes atendidos']);

        //Permisos  del rol logistica
        Permission::create(['name' => 'ver insumo']);
        Permission::create(['name' => 'registrar insumo']);
        Permission::create(['name' => 'modificar insumo']);
        Permission::create(['name' => 'eliminar insumo']);
        Permission::create(['name' => 'asignar insumo']);

        Permission::create(['name' => 'ver equipo']);
        Permission::create(['name' => 'registrar equipo']);
        Permission::create(['name' => 'modificar equipo']);
        Permission::create(['name' => 'eliminar equipo']);
        Permission::create(['name' => 'asignar equipo']);

        Permission::create(['name' => 'ver inventario']);
        Permission::create(['name' => 'ver inventario por area']);
        Permission::create(['name' => 'Registrar limpieza']);
        Permission::create(['name' => 'ver registro de limpieza']);
        Permission::create(['name' => 'Crear reporte']);

        //Permisos  del rol admon
        Permission::create(['name' => 'ver cuentas por pagar']);
        Permission::create(['name' => 'ver cuentas por cobrar']);


        /* por si existira 
        $role->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'Administrador@sinusandface.com',
            'password' => 'admin'
        ]);

        $user->assignRole('administrador');
        echo 'User admin has been created';
        */

    }
}
