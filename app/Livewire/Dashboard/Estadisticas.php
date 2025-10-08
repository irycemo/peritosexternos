<?php

namespace App\Livewire\Dashboard;

use App\Models\Avaluo;
use Livewire\Component;

class Estadisticas extends Component
{

    public $avaluos_nuevos = 0;
    public $avaluos_operados = 0;
    public $avaluos_concluidos = 0;
    public $avaluos_por_conciliar = 0;

    public function mount(){

        if(auth()->user()->hasRole('Valuador')){

            $this->avaluos_nuevos = Avaluo::where('creado_por', auth()->id())->where('estado', 'nuevo')->count();
            $this->avaluos_operados = Avaluo::where('creado_por', auth()->id())->where('estado', 'operado')->count();
            $this->avaluos_concluidos = Avaluo::where('creado_por', auth()->id())->where('estado', 'concluido')->count();
            $this->avaluos_por_conciliar = Avaluo::where('creado_por', auth()->id())->whereHas('predio', function($q) { $q->whereIn('sector', [88,99]); })->count();

        }else{

            $this->avaluos_nuevos = Avaluo::where('estado', 'nuevo')->count();
            $this->avaluos_operados = Avaluo::where('estado', 'operado')->count();
            $this->avaluos_concluidos = Avaluo::where('estado', 'concluido')->count();
            $this->avaluos_por_conciliar = Avaluo::whereHas('predio', function($q) { $q->whereIn('sector', [88,99]); })->count();

        }

    }

    public function render()
    {
        return view('livewire.dashboard.estadisticas');
    }
}
