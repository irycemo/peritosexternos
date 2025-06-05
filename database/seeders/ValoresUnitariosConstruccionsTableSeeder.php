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


        \DB::table('valor_unitario_construccions')->delete();

        \DB::table('valor_unitario_construccions')->insert(array (
            0 =>
            array (
                'id' => 1,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '754.00',
                'valor_aterior' => '723.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            1 =>
            array (
                'id' => 2,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            2 =>
            array (
                'id' => 3,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '1273.00',
                'valor_aterior' => '1220.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            3 =>
            array (
                'id' => 4,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            4 =>
            array (
                'id' => 5,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '1777.00',
                'valor_aterior' => '1703.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            5 =>
            array (
                'id' => 6,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            6 =>
            array (
                'id' => 7,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '2524.00',
                'valor_aterior' => '2419.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            7 =>
            array (
                'id' => 8,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            8 =>
            array (
                'id' => 9,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '3194.00',
                'valor_aterior' => '3062.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            9 =>
            array (
                'id' => 10,
                'tipo' => 1,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            10 =>
            array (
                'id' => 11,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '754.00',
                'valor_aterior' => '723.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            11 =>
            array (
                'id' => 12,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            12 =>
            array (
                'id' => 13,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '1273.00',
                'valor_aterior' => '1220.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            13 =>
            array (
                'id' => 14,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            14 =>
            array (
                'id' => 15,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '1777.00',
                'valor_aterior' => '1703.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            15 =>
            array (
                'id' => 16,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            16 =>
            array (
                'id' => 17,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '2524.00',
                'valor_aterior' => '2419.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            17 =>
            array (
                'id' => 18,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            18 =>
            array (
                'id' => 19,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '3194.00',
                'valor_aterior' => '3062.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            19 =>
            array (
                'id' => 20,
                'tipo' => 1,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            20 =>
            array (
                'id' => 21,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '1273.00',
                'valor_aterior' => '1220.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            21 =>
            array (
                'id' => 22,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            22 =>
            array (
                'id' => 23,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '1777.00',
                'valor_aterior' => '1703.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            23 =>
            array (
                'id' => 24,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            24 =>
            array (
                'id' => 25,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '2524.00',
                'valor_aterior' => '2419.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            25 =>
            array (
                'id' => 26,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            26 =>
            array (
                'id' => 27,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            27 =>
            array (
                'id' => 28,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            28 =>
            array (
                'id' => 29,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '5055.00',
                'valor_aterior' => '4846.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            29 =>
            array (
                'id' => 30,
                'tipo' => 2,
                'uso' => 1,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '6068.00',
                'valor_aterior' => '5817.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            30 =>
            array (
                'id' => 31,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '1273.00',
                'valor_aterior' => '1220.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            31 =>
            array (
                'id' => 32,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            32 =>
            array (
                'id' => 33,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '1777.00',
                'valor_aterior' => '1703.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            33 =>
            array (
                'id' => 34,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            34 =>
            array (
                'id' => 35,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '2524.00',
                'valor_aterior' => '2419.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            35 =>
            array (
                'id' => 36,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            36 =>
            array (
                'id' => 37,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            37 =>
            array (
                'id' => 38,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            38 =>
            array (
                'id' => 39,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '5055.00',
                'valor_aterior' => '4846.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            39 =>
            array (
                'id' => 40,
                'tipo' => 2,
                'uso' => 2,
                'calidad' => 3,
                'estado' => 4,
                'valor' => '6068.00',
                'valor_aterior' => '5817.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            40 =>
            array (
                'id' => 41,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 1,
                'valor' => '1007.00',
                'valor_aterior' => '965.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            41 =>
            array (
                'id' => 42,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 2,
                'valor' => '1519.00',
                'valor_aterior' => '1456.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            42 =>
            array (
                'id' => 43,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 1,
                'estado' => 3,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            43 =>
            array (
                'id' => 44,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 1,
                'valor' => '2026.00',
                'valor_aterior' => '1942.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            44 =>
            array (
                'id' => 45,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 2,
                'valor' => '2623.00',
                'valor_aterior' => '2514.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            45 =>
            array (
                'id' => 46,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 2,
                'estado' => 3,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            46 =>
            array (
                'id' => 47,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 1,
                'valor' => '3051.00',
                'valor_aterior' => '2925.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            47 =>
            array (
                'id' => 48,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 2,
                'valor' => '3549.00',
                'valor_aterior' => '3402.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
            48 =>
            array (
                'id' => 49,
                'tipo' => 2,
                'uso' => 3,
                'calidad' => 3,
                'estado' => 3,
                'valor' => '4050.00',
                'valor_aterior' => '3882.00',
                'created_at' => '2024-06-06 08:28:23',
                'updated_at' => '2024-06-06 08:28:23',
            ),
        ));


    }
}
