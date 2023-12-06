<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Valuador']);
        $role2 = Role::create(['name' => 'Director']);
        $role2 = Role::create(['name' => 'Jefe de departamento']);

        Permiso::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permiso::create(['name' => 'Auditoria', 'area' => 'Auditoria'])->syncRoles([$role1]);
        Permiso::create(['name' => 'Logs', 'area' => 'Logs'])->syncRoles([$role1]);

    }
}
