<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ValoresUnitariosConstruccionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('valores_unitarios_contruccions')->delete();

        \DB::table('valores_unitarios_contruccions')->insert(array (
            0 =>
            array (
                'id' => 2,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            1 =>
            array (
                'id' => 4,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            2 =>
            array (
                'id' => 6,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            3 =>
            array (
                'id' => 8,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            4 =>
            array (
                'id' => 10,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            5 =>
            array (
                'id' => 12,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            6 =>
            array (
                'id' => 14,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            7 =>
            array (
                'id' => 16,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            8 =>
            array (
                'id' => 18,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            9 =>
            array (
                'id' => 20,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            10 =>
            array (
                'id' => 22,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            11 =>
            array (
                'id' => 24,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            12 =>
            array (
                'id' => 26,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            13 =>
            array (
                'id' => 28,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            14 =>
            array (
                'id' => 30,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '6068.00',
                'valor_aterior' => '5817.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            15 =>
            array (
                'id' => 32,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            16 =>
            array (
                'id' => 34,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            17 =>
            array (
                'id' => 36,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            18 =>
            array (
                'id' => 38,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            19 =>
            array (
                'id' => 40,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '6068.00',
                'valor_aterior' => '5817.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            20 =>
            array (
                'id' => 42,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            21 =>
            array (
                'id' => 44,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            22 =>
            array (
                'id' => 46,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            23 =>
            array (
                'id' => 48,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            24 =>
            array (
                'id' => 50,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '2623.00',
                'valor_aterior' => '2514.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            25 =>
            array (
                'id' => 52,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            26 =>
            array (
                'id' => 54,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '3046.00',
                'valor_aterior' => '2920.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            27 =>
            array (
                'id' => 56,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),
            28 =>
            array (
                'id' => 58,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),

            29 =>
            array (
                'id' => 59,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '4846.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2023-10-05 10:02:22',
                'updated_at' => '2024-06-04 16:54:14',
            ),

        ));


    }
}
