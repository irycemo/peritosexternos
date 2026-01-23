<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Refrendo;
use App\Constantes\Constantes;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Services\SGCService\SGCService;

class PeritoRefrendo extends Component
{

    public $años;
    public $año;
    public $folio;
    public $usuario;

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

                (new SGCService())->crearTramiteRefrendo(auth()->user()->name, auth()->user()->clave, auth()->user()->email);

            });

            $this->dispatch('mostrarMensaje', ['success', 'El trámite se creó con éxito, la información se envió a su correo electrónico.']);

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

    public function mount(){

        $this->años = Constantes::AÑOS;

        $this->año = now()->year;

    }

    public function render()
    {
        return view('livewire.admin.perito-refrendo');
    }
}
