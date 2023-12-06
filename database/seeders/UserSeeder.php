<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Enrique',
            'ap_paterno' => 'Robledo',
            'ap_materno' => 'Camacho',
            'status' => 'activo',
            'email' => 'correo@correo.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Tomas',
            'ap_paterno' => 'Hernandez',
            'ap_materno' => 'Cuellar',
            'status' => 'activo',
            'email' => 'tomas.hernandez@plancartemorelia.edu.mx',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Martin',
            'ap_paterno' => 'Cervantes',
            'ap_materno' => 'Osorio',
            'status' => 'activo',
            'email' => 'cervantes.martin@gmail.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Mauricio',
            'ap_paterno' => 'Landa',
            'ap_materno' => 'Herrera',
            'status' => 'activo',
            'email' => 'mlanda64@hotmail.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Salvador',
            'ap_paterno' => 'Sanchez',
            'ap_materno' => 'Alvarez',
            'status' => 'activo',
            'email' => 'ssacat@outlook.com',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Saul',
            'ap_paterno' => 'Hernandez',
            'ap_materno' => 'Castro',
            'status' => 'activo',
            'email' => 'scastro@michoacan.gob.mx',
            'password' => bcrypt('sistema'),
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Sergio Arturo',
            'ap_paterno' => 'Calvillo',
            'ap_materno' => 'Corral',
            'status' => 'activo',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Director');

        User::create([
            'name' => 'Martin',
            'ap_paterno' => 'Calvillo',
            'ap_materno' => 'Corral',
            'status' => 'activo',
            'email' => 'correo3@correo.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Jefe de departamento');

    }
}
