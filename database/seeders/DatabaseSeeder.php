<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UmaSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ValoresUnitariosRusticosTableSeeder;
use Database\Seeders\ValoresUnitariosConstruccionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ValoresUnitariosConstruccionsTableSeeder::class);
        $this->call(ValoresUnitariosRusticosTableSeeder::class);
        $this->call(UmaSeeder::class);

        $this->call(ValorUnitarioConstruccionsTableSeeder::class);
    }
}
