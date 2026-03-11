<?php

namespace App\Livewire\Admin;

use App\Models\ValorUnitarioConstruccion;
use App\Traits\ComponentesTrait;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ValoresUnitariosConstruccion extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public ValorUnitarioConstruccion $modelo_editar;

    public $tipo;
    public $uso;
    public $estado;
    public $calidad;

    protected function rules(){
        return [
            'modelo_editar.tipo' => 'required|numeric',
            'modelo_editar.uso' => 'required|numeric',
            'modelo_editar.estado' => 'required|numeric',
            'modelo_editar.calidad' => 'required|numeric',
            'modelo_editar.valor' => 'required|numeric',
            'modelo_editar.valor_aterior' => 'required|numeric'
         ];
    }

    public function crearModeloVacio(){
        $this->modelo_editar = ValorUnitarioConstruccion::make();
    }

    public function abrirModalEditar(ValorUnitarioConstruccion $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo))
            $this->modelo_editar = $modelo;

    }

    public function actualizar(){

        try{

            $this->modelo_editar->save();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El valor se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualizar valor unitario de construcción por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $valor = ValorUnitarioConstruccion::find($this->selected_id);

            $valor->delete();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El valor se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar valor unitario de construcción por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    #[Computed]
    public function valores(){

        return ValorUnitarioConstruccion::select('id', 'tipo', 'uso', 'estado', 'calidad', 'valor', 'valor_aterior')
                        ->when($this->tipo && $this->tipo != '', function($q){
                            $q->where('tipo', $this->tipo);
                        })
                        ->when($this->uso && $this->uso != '', function($q){
                            $q->where('uso', $this->uso);
                        })
                        ->when($this->estado && $this->estado != '', function($q){
                            $q->where('estado', $this->estado);
                        })
                        ->when($this->calidad && $this->calidad != '', function($q){
                            $q->where('calidad', $this->calidad);
                        })
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);
    }

    public function render()
    {
        return view('livewire.admin.valores-unitarios-construccion')->extends('layouts.admin');
    }

}
