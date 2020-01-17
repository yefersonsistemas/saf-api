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
     
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        Role::truncate();
        Permission::truncate();

        //Roles de usuarios
        // $role = Role::create(['name' => 'director']);
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

        //Permiso del rol director
        Permission::create(['name' => 'ver lista de empleados']);
        Permission::create(['name' => 'registrar empleados']);
        Permission::create(['name' => 'modificar empleados']);
        Permission::create(['name' => 'eliminar empleados']);

        Permission::create(['name' => 'ver lista de registros']);
        Permission::create(['name' => 'ver lista de emppleados']);

        Permission::create(['name' => 'registrar cargo']);
        Permission::create(['name' => 'modificar cargo']);
        Permission::create(['name' => 'eliminar cargo']);

        Permission::create(['name' => 'registrar clase de doctor']);
        Permission::create(['name' => 'modificar clase de doctor']);
        Permission::create(['name' => 'eliminar clase de doctor']);

        Permission::create(['name' => 'registrar servicios']);
        Permission::create(['name' => 'modificar servicios']);
        Permission::create(['name' => 'eliminar servicios']);

        Permission::create(['name' => 'registrar procedimiento']);
        Permission::create(['name' => 'eliminar procedimiento']);
        Permission::create(['name' => 'modificar procedimiento']);

        Permission::create(['name' => 'registrar especialidad']);
        Permission::create(['name' => 'eliminar especialidad']);
        Permission::create(['name' => 'modificar especialidad']);

        Permission::create(['name' => 'registrar cirugias']);
        Permission::create(['name' => 'eliminar cirugias']);
        Permission::create(['name' => 'modificar cirugias']);

        Permission::create(['name' => 'registrar tipo de cirugias']);
        Permission::create(['name' => 'eliminar tipo de cirugias']);
        Permission::create(['name' => 'modificar tipo de cirugias']);

        Permission::create(['name' => 'registrar alergias']);
        Permission::create(['name' => 'eliminar alergias']);
        Permission::create(['name' => 'modificar alergias']);

        Permission::create(['name' => 'registrar enfermedades']);
        Permission::create(['name' => 'eliminar enfermedades']);
        Permission::create(['name' => 'modificar enfermedades']);

        Permission::create(['name' => 'registrar medicina']);
        Permission::create(['name' => 'eliminar medicina']);
        Permission::create(['name' => 'modificar medicina']);

        Permission::create(['name' => 'registrar examenes']);
        Permission::create(['name' => 'eliminar examenes']);
        Permission::create(['name' => 'modificar examenes']);

        Permission::create(['name' => 'registrar area']);
        Permission::create(['name' => 'eliminar area']);
        Permission::create(['name' => 'modificar area']);

        Permission::create(['name' => 'registrar tipo de area']);
        Permission::create(['name' => 'eliminar tipo de area']);
        Permission::create(['name' => 'modificar tipo de area']);
        
        Permission::create(['name' => 'registrar tipo de pago']);
        Permission::create(['name' => 'eliminar tipo de pago']);
        Permission::create(['name' => 'modificar tipo de pago']);

        Permission::create(['name' => 'registrar precio de consulta']);
        Permission::create(['name' => 'modificar precio de consulta']);
        Permission::create(['name' => 'eliminar precio de consulta']);

        Permission::create(['name' => 'asignar permisos']);
        Permission::create(['name' => 'revocar permisos']);

        
        // $role->givePermissionTo(Permission::all());

        // $user = User::create([
        //     'person_id' => $person->id,
        //     'email' => $person->email,
        //     'password' => 'password',
        //     'branch_id' => '1',
        // ]);

        // $user->assignRole('director');
        // echo 'User admin has been created';
        

    }
}
