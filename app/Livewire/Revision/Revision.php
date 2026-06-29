<?php

namespace App\Livewire\Revision;

use Livewire\Component;

class Revision extends Component
{
    public function render()
    {
        return view('livewire.revision.revision')->extends('layouts.admin');
    }
}
