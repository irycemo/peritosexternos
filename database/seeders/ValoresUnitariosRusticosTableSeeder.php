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
                'valor' => '8434.00',
                'valor_aterior' => '8084.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            1 => 
            array (
                'id' => 2,
                'concepto' => 'MONTE BAJO',
                'valor' => '2108.00',
                'valor_aterior' => '2020.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            2 => 
            array (
                'id' => 3,
                'concepto' => 'HUMEDAD',
                'valor' => '14050.00',
                'valor_aterior' => '13468.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            3 => 
            array (
                'id' => 4,
                'concepto' => 'RIEGO MECANICO',
                'valor' => '21086.00',
                'valor_aterior' => '20212.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            4 => 
            array (
                'id' => 5,
                'concepto' => 'TEMPORAL DE SEGUNDA',
                'valor' => '5621.00',
                'valor_aterior' => '5388.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            5 => 
            array (
                'id' => 6,
                'concepto' => 'TEMPORAL DE TERCERA',
                'valor' => '3506.00',
                'valor_aterior' => '3360.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            6 => 
            array (
                'id' => 7,
                'concepto' => 'ERIAZO',
                'valor' => '697.00',
                'valor_aterior' => '668.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            7 => 
            array (
                'id' => 8,
                'concepto' => 'MONTE ALTO',
                'valor' => '7034.00',
                'valor_aterior' => '6742.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            8 => 
            array (
                'id' => 9,
                'concepto' => 'RIEGO POR GRAVEDAD',
                'valor' => '28097.00',
                'valor_aterior' => '26933.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
            9 => 
            array (
                'id' => 10,
                'concepto' => 'AGOSTADERO',
                'valor' => '2108.00',
                'valor_aterior' => '2020.00',
                'created_at' => NULL,
                'updated_at' => '2024-06-04 15:20:50',
            ),
        ));
        
        
    }
}