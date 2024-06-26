<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::shouldBeStrict();

        LogViewer::auth(function ($request) {

            if(auth()->user()->hasRole('Administrador'))
                return true;
            else
                abort(401, 'Unauthorized');

        });

        if(!env('LOCAL')){

            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/peritosexternos/public/livewire/livewire.js', $handle);
            });

            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/peritosexternos/public/livewire/update', $handle);
            });

        }

    }
}
