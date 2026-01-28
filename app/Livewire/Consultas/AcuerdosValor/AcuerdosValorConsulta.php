<?php

namespace App\Livewire\Consultas\AcuerdosValor;

use Livewire\Component;
use App\Models\AcuerdoValor;
use App\Traits\ComponentesTrait;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class AcuerdosValorConsulta extends Component
{

    use WithPagination;
    use ComponentesTrait;

    public AcuerdoValor $modelo_editar;

    public function crearModeloVacio(){
        $this->modelo_editar = AcuerdoValor::make();
    }

    #[Computed]
    public function acuerdos(){

        return AcuerdoValor::select('id','año', 'folio', 'municipio', 'localidad', 'nombre_asentamiento', 'calles', 'valor_inicial', 'valor_actualizado')
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
        return view('livewire.consultas.acuerdos-valor.acuerdos-valor-consulta')->extends('layouts.admin');
    }
}
