<?php

namespace App\Jobs\Avaluos;

use App\Models\Avaluo;
use Illuminate\Support\Facades\DB;
use App\Services\SGCService\SGCService;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\FirmaElectronicaController;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CrearCaratulaAvaluoJob implements ShouldQueue
{
    use Queueable;
    use Dispatchable;
    use InteractsWithQueue;
    use SerializesModels;

    public int $tries = 3;
    public int $backoff = 30;
    public int $timeout = 600;

    public function __construct(
        public Avaluo $avaluo,
        public User $user,
        public string $cer_path,
        public string $key_path,
        public string $password,
        public ?string $claveProceso = null,
    ){}

    public function handle(): void
    {

        $this->actualizarEstado(['status' => 'procesando']);

        DB::transaction(function (){

            if($this->avaluo->pdf){

                if(app()->isProduction()){

                    Storage::disk('s3')->delete(config('services.ses.ruta_pdfs') . $this->avaluo->pdf->url);

                }else{

                    Storage::disk('pdfs')->delete($this->avaluo->pdf->url);

                }

                $this->avaluo->pdf->delete();

            }

            $pdf = (new FirmaElectronicaController())->firmarElectronicamente($this->avaluo, $this->cer_path, $this->key_path, $this->password);

            $this->avaluo->update(['estado' => 'concluido']);

            $nombre = 'avaluo_' . $this->avaluo->folioAvaluo() . '_' . now()->format('Ymd_His') . '.pdf';

            if(app()->isProduction()){

                Storage::disk('s3')->put(config('services.ses.ruta_pdfs') . $nombre, $pdf->output());

            }else{

                Storage::put('pdfs/' . $nombre, $pdf->output());

            }

            File::create([
                'fileable_id' => $this->avaluo->id,
                'fileable_type' => 'App\Models\Avaluo',
                'descripcion' => 'pdf',
                'url' => $nombre
            ]);

            $this->actualizarEstado([
                'status' => 'listo',
                's3_path' => config('services.ses.ruta_pdfs') . $nombre,
                'filename' => $nombre,
            ]);

        });

        (new SGCService)->actualizarEsHabitacional($this->avaluo->predio->localidad, $this->avaluo->predio->oficina, $this->avaluo->predio->tipo_predio, $this->avaluo->predio->numero_registro, $this->avaluo->predio->es_habitacional);

    }

    private function actualizarEstado(array $nuevo): void
    {

        if (! $this->claveProceso) {

            return;

        }

        $actual = Cache::get($this->claveProceso) ?? [];

        Cache::put($this->claveProceso, array_merge($actual, $nuevo), now()->addMinutes(30));

    }

    public function failed(Throwable $exception): void
    {

        Log::error(
            'Fallo CrearCaratulaAvaluoJob tras agotar los intentos.',
            [
                'message' => $exception->getMessage(),
                'avaluo_id' => $this->avaluo->id,
                'folio_avaluo' => $this->avaluo->folioAvaluo(),
                'usuario_id' => $this->user->id,
                'trace' =>  $exception->getTraceAsString()
            ]
        );

        if (! $this->claveProceso) {

            return;

        }

        Cache::put(
            $this->claveProceso,
            [
                'status' => 'error',
                'mensaje' => 'No fue posible generar el avalúo. Intenta de nuevo.',
            ],
            now()->addMinutes(30)
        );

    }

}
