<?php

namespace App\Console\Commands;

use App\Models\Avaluo;
use App\Services\SGCService\SGCService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevisarConsolidaciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consolidaciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa en el padrón catastral si han sido conciliados los predios de los avalúos en estado conciliación';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {

            $avaluos = Avaluo::with('predio')->where('estado', 'conciliar')->get();

            foreach ($avaluos as $avaluo) {

                $data = (new SGCService())->consultarPredio($avaluo->predio->localidad, $avaluo->predio->oficina, $avaluo->predio->tipo_predio,$avaluo->predio->numero_registro);

                if(
                    $data['data']['region_catastral'] != $avaluo->predio->region_catastral ||
                    $data['data']['municipio'] != $avaluo->predio->municipio ||
                    $data['data']['zona_catastral'] != $avaluo->predio->zona_catastral ||
                    $data['data']['localidad'] != $avaluo->predio->localidad ||
                    $data['data']['sector'] != $avaluo->predio->sector ||
                    $data['data']['manzana'] != $avaluo->predio->manzana ||
                    $data['data']['predio'] != $avaluo->predio->predio ||
                    $data['data']['edificio'] != $avaluo->predio->edificio ||
                    $data['data']['departamento'] != $avaluo->predio->departamento ||
                    $data['data']['oficina'] != $avaluo->predio->oficina ||
                    $data['data']['tipo_predio'] != $avaluo->predio->tipo_predio ||
                    $data['data']['numero_registro'] != $avaluo->predio->numero_registro
                ){

                    $avaluo->predio->update([
                        'region_catastral' => $data['data']['region_catastral'],
                        'municipio' => $data['data']['municipio'],
                        'zona_catastral' => $data['data']['zona_catastral'],
                        'localidad' => $data['data']['localidad'],
                        'sector' => $data['data']['sector'],
                        'manzana' => $data['data']['manzana'],
                        'predio' => $data['data']['predio'],
                        'edificio' => $data['data']['edificio'],
                        'departamento' => $data['data']['departamento'],
                        'oficina' => $data['data']['oficina'],
                        'tipo_predio' => $data['data']['tipo_predio'],
                        'numero_registro' => $data['data']['numero_registro'],
                    ]);

                    $avaluo->update(['estado' => 'nuevo']);

                    info('Avaluo: ' . $avaluo->año . '-' . $avaluo->folio . '-' . $avaluo->usuario . ' ha sido conciliado mediante tarea programada.');

                }

            }

        } catch (\Throwable $th) {

            Log::error("Error al ejecutar tarea de conciliacion de predios. " . $th);

        }

    }
}
