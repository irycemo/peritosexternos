<?php

namespace App\Http\Controllers\Valuacion;

use App\Models\Avaluo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValuacionController extends Controller
{

    public function __invoke(Avaluo $avaluo)
    {

        if($avaluo->getKey())
            $this->authorize('view', $avaluo);

        $id = $avaluo->id;

        return view('valuacion.valuacion', compact('id'));

    }
}
