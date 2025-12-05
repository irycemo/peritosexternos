<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;

class DashboardController extends Controller
{

    public function __invoke()
    {

        $preguntas = Pregunta::latest()->take(5)->get();

        return view('dashboard', compact('preguntas'));

    }

}
