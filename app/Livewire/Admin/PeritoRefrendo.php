<?php

namespace App\Livewire\Admin;

use App\Constantes\Constantes;
use App\Exceptions\GeneralException;
use App\Mail\EnviarTramiteMail;
use App\Models\Refrendo;
use App\Services\SGCService\SGCService;
use App\Traits\SapTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PeritoRefrendo extends Component
{

    use SapTrait;

    public $años;
    public $año;
    public $folio;
    public $usuario;

    public $pdf;

    public $token;
    public $linea_de_captura;
    public $monto;
    public $fecha_vencimiento;
    public $link_pago_linea;

    protected function rules(){
        return [
            'año' => 'required|numeric',
            'folio' => 'required|numeric',
            'usuario' => 'required|numeric',
         ];
    }

    #[Computed]
    public function refrendos(){

        return Refrendo::select('id', 'año', 'folio', 'usuario', 'linea_captura', 'user_id', 'estado')
                    ->where('user_id', auth()->id())
                    ->get();
    }

    public function buscarTramite(){

        $this->validate();

        try {

            $this->revisarTramiteExistente();

            DB::transaction(function () {

                $tramite = (new SGCService())->buscarTramiteRefrendo($this->año, $this->folio, $this->usuario);

                auth()->user()->refrendos()->create([
                    'año' => $tramite['data']['año'],
                    'folio' => $tramite['data']['folio'],
                    'usuario' => $tramite['data']['usuario'],
                    'tramite_id_sgc' => $tramite['data']['id'],
                    'linea_captura' => $tramite['data']['tipo_tramite'] == 'exento' ? 'Exento' : $tramite['data']['linea_de_captura'],
                    'estado' => 'activo',
                ]);

            });

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al ingresar refrendo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function crearTramite(){

        try {

            DB::transaction(function () {

                $data = (new SGCService())->crearTramiteRefrendo(auth()->user()->name, auth()->user()->clave, auth()->user()->email);

                $this->pdf = $data['pdf'];

                $this->linea_de_captura = $data['data']['linea_de_captura'];
                $this->monto = $data['data']['monto'];
                $this->fecha_vencimiento = $data['data']['fecha_vencimiento'];

                if($data['nuevo']){

                    $titulo = 'Trámite de refrendo anual.';

                    Mail::to(auth()->user()->email)->send(new EnviarTramiteMail($titulo, $data));

                    $this->dispatch('mostrarMensaje', ['success', 'El trámite se creó con éxito, la información se envió a su correo electrónico.']);

                }else{

                    $this->dispatch('mostrarMensaje', ['warning', 'Ya tiene registrado un trámite de refrendo anual.']);

                }

                $this->token = $this->encrypt_decrypt("encrypt", $this->linea_de_captura . $this->monto . config('services.sap.concepto') . $this->fecha_vencimiento);

            });

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al ingresar refrendo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);

        }

    }

    public function revisarTramiteExistente(){

        $refrendo = Refrendo::where('año', $this->año)
                            ->where('folio', $this->folio)
                            ->where('usuario', $this->usuario)
                            ->first();

        if($refrendo){

            throw new GeneralException('El trámite ya esta registrado.');

        }

    }

    public function descargarOrdenPago(){

        try {

            $pdf = base64_decode($this->pdf);

            return response()->streamDownload(
                fn () => print($pdf),
                'refrendo.pdf'
            );

        } catch (\Throwable $th) {
            Log::error("Error al descargar orden de pago de refrendo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
        }

    }

    public function mount(){

        $this->años = Constantes::AÑOS;

        $this->año = now()->year;

        $this->link_pago_linea = config('services.sap.link_pago_linea');

    }

    public function render()
    {
        return view('livewire.admin.perito-refrendo');
    }
}
