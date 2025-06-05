<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Enrique Robledo Camacho',
            'status' => 'activo',
            'email' => 'enrique_j_@hotmail.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Tomas Hernandez Cuellar',
            'status' => 'activo',
            'email' => 'tomas.hernandez@plancartemorelia.edu.mx',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Martin Cervantes Osorio',
            'status' => 'activo',
            'email' => 'cervantes.martin@gmail.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Mauricio Landa Herrera',
            'status' => 'activo',
            'email' => 'mlanda64@hotmail.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Salvador Sanchez Alvarez',
            'status' => 'activo',
            'email' => 'ssacat@outlook.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Saul Hernandez Castro',
            'status' => 'activo',
            'email' => 'scastro@michoacan.gob.mx',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'clave' => 11,
            'name' => 'Sistema trámites en línea',
            'status' => 'activo',
            'email' => 'sistematramiteslinea@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Sistemas');

        User::create([
            'clave' => 12,
            'name' => 'Sistema de Gestión Catastral',
            'status' => 'activo',
            'email' => 'sgc@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Sistemas');

    }
}
