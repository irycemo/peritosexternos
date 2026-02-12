<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentacionCompletaMiddleware
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

        if(! auth()->user()->imagenes()->where('descripcion', 'actaNacimiento')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'comprobanteRecidencia')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'curriculum')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'cedulaEspecialidad')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'fianza')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'pagoCredencial')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'registroAsociacion')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(! auth()->user()->imagenes()->where('descripcion', 'foto')->first()){

            abort(403, "No ha cargado la documentación completa, puede hacerlo en el área de perfil de usuario.");

        }

        if(auth()->user()->status === 'revision'){

            abort(403, "Tu cuenta esta en revisión, contacta al administrador.");

        }

        return $next($request);

    }
}
