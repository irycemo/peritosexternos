<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RefrendoActivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user()->hasRole(['Administrador'])){

            return $next($request);

        }

        if(! auth()->user()->refrendos()->where('año', now()->year)->where('estado', 'activo')->first()){

            abort(403, "No hay registro de un refrendo activo, puede gestionarlo en el área de perfil de usuario.");

        }

        return $next($request);
    }
}
