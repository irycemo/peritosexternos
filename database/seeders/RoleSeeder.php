<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $role3 = Role::create(['name' => 'Aspirante']);
        $role4 = Role::create(['name' => 'Sistemas']);

        Permission::create(['name' => 'Lista de roles', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar rol', 'area' => 'Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar rol', 'area' => 'Roles'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de permisos', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar permiso', 'area' => 'Permisos'])->syncRoles([$role1]);

        Permission::create(['name' => 'Lista de usuarios', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Crear usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Editar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'Borrar usuario', 'area' => 'Usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'Umas', 'area' => 'Umas'])->syncRoles([$role1]);

        Permission::create(['name' => 'Avaluos', 'area' => 'Avaluos'])->syncRoles([$role1]);
        Permission::create(['name' => 'Auditoria', 'area' => 'Auditoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'Logs', 'area' => 'Logs'])->syncRoles([$role1]);

        Permission::create(['name' => 'Mis avaluos', 'area' => 'Valuación'])->syncRoles([$role1, $role2]);

    }
}
