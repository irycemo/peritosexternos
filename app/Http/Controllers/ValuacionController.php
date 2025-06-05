<?php

namespace App\Http\Controllers;

use App\Models\Avaluo;
use Illuminate\Http\Request;

class ValuacionController extends Controller
{

    public function __invoke(Avaluo $avaluo)
    {

        $id =  $avaluo->getKey() ? $avaluo->id : null;

        return view('valuacion.valuacion', compact('id'));

    }

}
