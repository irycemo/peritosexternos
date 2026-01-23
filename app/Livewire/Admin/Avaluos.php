<?php

namespace App\Livewire\Admin;

use App\Constantes\Constantes;
use App\Models\Avaluo;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FirmaElectronica;
use App\Traits\ComponentesTrait;
use App\Traits\AvaluoCadenaTrait;
use Livewire\Attributes\Computed;
use App\Traits\RevisarAvaluoTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Http\Controllers\AvaluoController;
use App\Http\Controllers\FirmaElectronicaController;

class Avaluos extends Component
{

    use ComponentesTrait;
    use WithPagination;
    use RevisarAvaluoTrait;
    use AvaluoCadenaTrait;

    public Avaluo $modelo_editar;

    public $avaluo;

    public $años;
    public $filters = [
        'año' => '',
        'folio' => '',
        'usuario' => '',
        'estado' => '',
        'localidad' => '',
        'oficina' => '',
        'tipo' => '',
        'registro' => ''
    ];

    public function updatedFilters() { $this->resetPage(); }

    public function crearModeloVacio(){
        return Avaluo::make();
    }

    public function reactivar(Avaluo $avaluo){

        try{

            DB::transaction(function () use($avaluo){

                $avaluo->update(['estado' => 'nuevo']);

                $this->resetCaratula($avaluo);

                $avaluo->audits()->latest()->first()->update(['tags' => 'Reactivó avaluo']);

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

            $pdf = (new AvaluoController())->avaluo($this->avaluo->predio);

            return response()->streamDownload(
                fn () => print($pdf->output()),
                'avalúo-' .$this->avaluo->predio->localidad . '-' . $this->avaluo->predio->oficina. '-' . $this->avaluo->predio->tipo_predio . '-'. $this->avaluo->predio->numero_registro. '.pdf'
            );

        } catch (GeneralException $ex) {

            $this->dispatch('mostrarMensaje', ['warning', $ex->getMessage()]);

        } catch (\Throwable $th) {

            Log::error("Error al crear avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    public function reimprimir(FirmaElectronica $firma_electronica){

        try {

            $pdf = (new FirmaElectronicaController())->reimprimirAvaluo($firma_electronica);

            return response()->streamDownload(
                fn () => print($pdf->output()),
                $firma_electronica->avaluo->predio->cuentaPredial() . '-certificado_de_registro.pdf'
            );

        } catch (\Throwable $th) {

            Log::error("Error al reimprimir avalúo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);

            $this->dispatch('mostrarMensaje', ['error', "Hubo un error."]);

        }

    }

    #[Computed]
    public function avaluos(){

        return Avaluo::select('id', 'predio_id', 'año', 'folio', 'usuario', 'estado', 'creado_por', 'actualizado_por', 'created_at', 'updated_at')
                        ->with('predio.propietarios.persona', 'creadoPor:id,name', 'actualizadoPor:id,name', 'firmaElectronica:id,avaluo_id,uuid')
                        ->where('año', $this->filters['año'])
                        ->when(strlen($this->filters['estado']) > 0, function($q){
                            $q->where('estado', $this->filters['estado']);
                        })
                        ->when(strlen($this->filters['folio']) > 0, function($q){
                            $q->where('folio', $this->filters['folio']);
                        })
                        ->when(strlen($this->filters['usuario']) > 0, function($q){
                            $q->where('usuario', $this->filters['usuario']);
                        })
                        ->when(strlen($this->filters['localidad']) > 0, function($q){
                            $q->whereHas('predio', function($q){
                                $q->where('localidad', $this->filters['localidad']);
                            });
                        })
                        ->when(strlen($this->filters['oficina']) > 0, function($q){
                            $q->whereHas('predio', function($q){
                                $q->where('oficina', $this->filters['oficina']);
                            });
                        })
                        ->when(strlen($this->filters['tipo']) > 0, function($q){
                            $q->whereHas('predio', function($q){
                                $q->where('tipo_predio', $this->filters['tipo']);
                            });
                        })
                        ->when(strlen($this->filters['registro']) > 0, function($q){
                            $q->whereHas('predio', function($q){
                                $q->where('numero_registro', $this->filters['registro']);
                            });
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

    }

    public function mount(){

        $this->años = Constantes::AÑOS;

        $this->filters['año'] = now()->year;

    }

    public function render()
    {
        return view('livewire.admin.avaluos')->extends('layouts.admin');
    }
}
