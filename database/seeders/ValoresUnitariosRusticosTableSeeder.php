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


        \DB::table('valores_unitarios_rusticos')->delete();

        \DB::table('valores_unitarios_rusticos')->insert(array (
            0 =>
            array (
                'id' => 1,
                'concepto' => 'TEMPORAL DE PRIMERA',
                'valor' => '8084.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'concepto' => 'MONTE BAJO',
                'valor' => '2020.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'concepto' => 'HUMEDAD',
                'valor' => '13468.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'concepto' => 'RIEGO MECANICO',
                'valor' => '20212.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'concepto' => 'TEMPORAL DE SEGUNDA',
                'valor' => '5388.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'concepto' => 'TEMPORAL DE TERCERA',
                'valor' => '3360.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'concepto' => 'ERIAZO',
                'valor' => '668.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'concepto' => 'MONTE ALTO',
                'valor' => '6742.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'concepto' => 'RIEGO POR GRAVEDAD',
                'valor' => '26933.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'concepto' => 'AGOSTADERO',
                'valor' => '2020.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
