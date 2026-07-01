<?php

namespace App\Livewire\Revision;

use App\Models\Avaluo;
use App\Models\User;
use Livewire\Component;

class Revision extends Component
{

    public $peritos;
    public $perito;

    public function revisarAvaluo(){

        $avaluo = Avaluo::whereDoesntHave('revisiones')
                            ->inRandomOrder()
                            ->where('creado_por', $this->perito)
                            ->first();

        return redirect()->route('ver_avaluo', ['avaluo' => $avaluo]);

    }

    public function mount(){

        $this->peritos = User::whereHas('roles', function($q){
            $q->where('name', 'Valuador');
        })
        ->orderBy('name')
        ->get();

    }

    public function render()
    {
        return view('livewire.revision.revision')->extends('layouts.admin');
    }
}
