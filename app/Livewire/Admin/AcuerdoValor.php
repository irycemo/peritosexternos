<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FactorIncremento;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;
use App\Models\AcuerdoValor as Model;

class AcuerdoValor extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public Model $modelo_editar;

    protected function rules(){
        return [
            'modelo_editar.año' => 'required',
            'modelo_editar.folio' => 'required',
            'modelo_editar.municipio' => 'required',
            'modelo_editar.localidad' => 'nullable',
            'modelo_editar.nombre_asentamiento' => 'required',
            'modelo_editar.calles' => 'required',
            'modelo_editar.valor_inicial' => 'required',
            'modelo_editar.valor_actualizado' => 'nullable',
         ];
    }

    protected $validationAttributes  = [
        'modelo_editar.nombre_asentamiento' => 'nombre del asentamiento',
        'modelo_editar.valor_inicial' => 'valor inicial',
        'modelo_editar.valor_actualizado' => 'valor actualizado',
    ];

    public function crearModeloVacio(){
        $this->modelo_editar = Model::make();
    }

    public function abrirModalEditar(Model $modelo){

        $this->resetearTodo();
        $this->modal = true;
        $this->editar = true;

        if($this->modelo_editar->isNot($modelo)) $this->modelo_editar = $modelo;

    }

    public function guardar(){

        $this->validate();

        try {

            $this->modelo_editar->valor_actualizado = $this->calcularValor($this->modelo_editar->año, $this->modelo_editar->valor_actual);
            $this->modelo_editar->creado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El acuerdo se creó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al crear acuerdo de valor por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function calcularValor($año, $valor_actual){

        $valor_actualizado = $valor_actual;

        $factores_incremento = FactorIncremento::orderBy('año', 'desc')->get();

        if($año < now()->year){

            foreach($factores_incremento as $factor){

                if($año < $factor->año){

                    $valor_actualizado = round($valor_actualizado * $factor->factor, 0);

                }

            }

        }

        return $valor_actualizado;

    }

    public function actualizar(){

        $this->validate();

        try{

            $this->modelo_editar->valor_actualizado = $this->calcularValor($this->modelo_editar->año, $this->modelo_editar->valor_actual);
            $this->modelo_editar->actualizado_por = auth()->user()->id;
            $this->modelo_editar->save();

            $this->resetearTodo();

            $this->dispatch('mostrarMensaje', ['success', "El acuerdo se actualizó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al actualzar acuerdo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    public function borrar(){

        try{

            $acuerdo = Model::find($this->selected_id);

            $acuerdo->delete();

            $this->resetearTodo($borrado = true);

            $this->dispatch('mostrarMensaje', ['success', "El acuerdo se eliminó con éxito."]);

        } catch (\Throwable $th) {

            Log::error("Error al borrar acuerdo por el usuario: (id: " . auth()->user()->id . ") " . auth()->user()->name . ". " . $th);
            $this->dispatch('mostrarMensaje', ['error', "Ha ocurrido un error."]);
            $this->resetearTodo();

        }

    }

    #[Computed]
    public function acuerdos(){

        return Model::select('id','año', 'folio', 'municipio', 'localidad', 'nombre_asentamiento', 'calles', 'valor_inicial', 'valor_actualizado', 'creado_por', 'actualizado_por', 'created_at', 'updated_at')
                        ->with('creadoPor:id,name', 'actualizadoPor:id,name')
                        ->where('municipio', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('localidad', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('nombre_asentamiento', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('calles', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('folio', 'LIKE', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->pagination);

    }

    public function render()
    {
        return view('livewire.admin.acuerdo-valor')->extends('layouts.admin');
    }
}
