<?php

namespace App\Livewire\Admin;

use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\ComponentesTrait;
use App\Traits\AvaluoCadenaTrait;
use Livewire\Attributes\Computed;
use App\Traits\RevisarAvaluoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Http\Controllers\AvaluoController;

class Avaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;
    use AvaluoCadenaTrait;

    public Avaluo $modelo_editar;

    public $avaluo;

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function reactivar(Avaluo $avaluo){

        try{

            DB::transaction(function () use($avaluo){

                $avaluo->update(['estado' => 'nuevo']);

                $this->resetCaratula($avaluo);

            });

            $this->dispatch('mostrarMensaje', ['success', "El avalúo se reactivó con éxito."]);;

        } catch (\Throwable $th) {

            Log::error("Error al actualizar usuario por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();
        }



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

    #[Computed]
    public function avaluos(){

        return Avaluo::with('predio.propietarios.persona', 'creadoPor', 'actualizadoPor', 'firmaElectronica')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.admin.avaluos')->extends('layouts.admin');
    }
}
