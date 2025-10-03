<?php

use App\Livewire\Admin\Umas;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Avaluos;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Admin\Auditoria;
use Illuminate\Support\Facades\Route;
use App\Livewire\Valuacion\MisAvaluos;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ValuacionController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\VerificacionController;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'esta.activo']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('roles', Roles::class)->middleware('can:Lista de roles')->name('roles');

    Route::get('permisos', Permisos::class)->middleware('can:Lista de permisos')->name('permisos');

    Route::get('usuarios', Usuarios::class)->middleware('can:Lista de usuarios')->name('usuarios');

    Route::get('auditoria', Auditoria::class)->middleware('can:Auditoria')->name('auditoria');

    Route::get('avaluos_admin', Avaluos::class)->middleware('can:Avaluos')->name('avaluos_admin');

    Route::get('umas', Umas::class)->middleware('can:Umas')->name('umas');

    /* Valuación */
    Route::get('mis_avaluos', MisAvaluos::class)->middleware('can:Mis avaluos')->name('mis_avaluos');

    Route::get('valuacion/{avaluo?}', ValuacionController::class)->name('valuacion');

});

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('manual', ManualController::class)->name('manual');

Route::get('verificacion/{firmaElectronica:uuid}', VerificacionController::class)->name('verificacion');