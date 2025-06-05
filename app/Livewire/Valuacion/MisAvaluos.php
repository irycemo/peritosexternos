<?php

namespace App\Livewire\Valuacion;

use App\Exceptions\GeneralException;
use App\Http\Controllers\AvaluoController;
use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use App\Traits\RevisarAvaluoTrait;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;

class MisAvaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;

    public Avaluo $modelo_editar;

    public $avaluo;

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function imprimir(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        try {

            $this->revisarAvaluoCompleto();

            if($this->avaluo->estado === 'nuevo'){

                $this->avaluo->update(['estado' => 'impreso']);

            }

            $pdf = (new AvaluoController())->avaluo($this->avaluo->predio);

            return response()->streamDownload(
                fn () => print($pdf->output()),
                'avaluo.pdf'
            );

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function concluirAvaluo(Avaluo $avaluo){

        $this->avaluo = $avaluo;

        try {

            $this->revisarAvaluoCompleto();

            $this->avaluo->update(['estado' => 'concluido']);

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al concluir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    #[Computed]
    public function avaluos(){

        return Avaluo::with('predio.propietarios.persona', 'creadoPor', 'actualizadoPor')
                            ->where('creado_por', auth()->id())
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.valuacion.mis-avaluos')->extends('layouts.admin');
    }
}
