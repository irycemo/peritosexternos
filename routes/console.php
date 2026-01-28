<?php

use App\Models\FactorIncremento;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('acuerdos', function(){

    Schema::disableForeignKeyConstraints();

    DB::table('acuerdo_valors')->truncate();

    $this->info('Incia migración de acuerdos de valor el: ' . now());

    $now = now()->toDateString();

    $handle = fopen(storage_path('app/public/acuerdos.csv'), 'r');

    fgets($handle);

    $chunkSize = 500;

    $chunks = [];

    $factores_incremento = FactorIncremento::orderBy('año', 'desc')->get();

    try {

        $rowPlaceholders = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        $placeholders = implode(',', array_fill(0, $chunkSize, $rowPlaceholders));

        $stmt =  DB::connection()->getPdo()->prepare("
                                                        INSERT INTO acuerdo_valors (año, folio, municipio, localidad, nombre_asentamiento, calles, valor_inicial, valor_actualizado, created_at, updated_at)
                                                        VALUES {$placeholders}
                                                    ");

        while(($line = fgetcsv($handle)) !== false){

            $valor_actualizado = (int)$line[6];

            if((int)$line[0] < now()->year){

                foreach($factores_incremento as $factor){

                    if((int)$line[0] < $factor->año){

                        $valor_actualizado = round($valor_actualizado * $factor->factor, 0);

                    }

                }

            }

            $chunks = array_merge($chunks, [
                $line[0], //Año
                $line[1], //folio
                trim($line[2]), //municipio
                trim($line[3]), //localidad
                trim($line[4]), //nombre_asentamiento
                trim($line[5]), //calles
                $line[6], //valor_inicial
                $valor_actualizado, //valor_actualizado
                $now,
                $now
            ]);

            if(count($chunks) === $chunkSize * 10){

                $stmt->execute($chunks);

                $chunks = [];

            }

        }

        if(!empty($chunks)){

            $remainingRows = count($chunks) / 10;

            $rowPlaceholders = '(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

            $placeholders = implode(',', array_fill(0, $remainingRows, $rowPlaceholders));

            $stmt = DB::connection()->getPdo()->prepare("
                                                        INSERT INTO acuerdo_valors (año, folio, municipio, localidad, nombre_asentamiento, calles, valor_inicial, valor_actualizado, created_at, updated_at)
                                                        VALUES {$placeholders}
                                                    ");

            $stmt->execute($chunks);

        }

        $this->info('Finaliza migración de acuerdos el: ' . now());

    }  finally {

        info($line);
        fclose($handle);

    }

});