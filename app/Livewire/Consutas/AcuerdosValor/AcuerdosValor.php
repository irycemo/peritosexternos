<?php

namespace App\Livewire\Consutas\AcuerdosValor;

use Livewire\Component;

class AcuerdosValor extends Component
{
    public function render()
    {
        return view('livewire.consutas.acuerdos-valor.acuerdos-valor')->extends('layouts.admin');
    }
}
