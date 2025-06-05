<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ValoresUnitariosRusticosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('valor_unitario_rusticos')->delete();

        \DB::table('valor_unitario_rusticos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'concepto' => 'TEMPORAL DE PRIMERA',
                'valor' => '8433.00',
                'valor_aterior' => '8084.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            1 =>
            array (
                'id' => 2,
                'concepto' => 'MONTE BAJO',
                'valor' => '2107.00',
                'valor_aterior' => '2020.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            2 =>
            array (
                'id' => 3,
                'concepto' => 'HUMEDAD',
                'valor' => '14050.00',
                'valor_aterior' => '13468.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            3 =>
            array (
                'id' => 4,
                'concepto' => 'RIEGO MECANICO',
                'valor' => '21085.00',
                'valor_aterior' => '20212.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            4 =>
            array (
                'id' => 5,
                'concepto' => 'TEMPORAL DE SEGUNDA',
                'valor' => '5621.00',
                'valor_aterior' => '5388.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            5 =>
            array (
                'id' => 6,
                'concepto' => 'TEMPORAL DE TERCERA',
                'valor' => '3505.00',
                'valor_aterior' => '3360.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            6 =>
            array (
                'id' => 7,
                'concepto' => 'ERIAZO',
                'valor' => '697.00',
                'valor_aterior' => '668.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            7 =>
            array (
                'id' => 8,
                'concepto' => 'MONTE ALTO',
                'valor' => '7033.00',
                'valor_aterior' => '6742.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            8 =>
            array (
                'id' => 9,
                'concepto' => 'RIEGO POR GRAVEDAD',
                'valor' => '28097.00',
                'valor_aterior' => '26933.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
            9 =>
            array (
                'id' => 10,
                'concepto' => 'AGOSTADERO',
                'valor' => '2107.00',
                'valor_aterior' => '2020.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 16:54:14',
            ),
        ));


    }
}