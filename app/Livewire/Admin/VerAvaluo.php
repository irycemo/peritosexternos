<?php

namespace App\Livewire\Admin;

use App\Models\Avaluo;
use Livewire\Component;

class VerAvaluo extends Component
{

    public Avaluo $avaluo;
    public $predio;

    public function mount(){

        $this->predio = $this->avaluo->predio;

        $this->predio->load('propietarios.persona');

    }

    public function render()
    {
        return view('livewire.admin.ver-avaluo')->extends('layouts.admin');
    }

}
