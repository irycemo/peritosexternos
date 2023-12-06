<?php

use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Admin\Auditoria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'esta.activo']], function(){

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    /* Administración */
    Route::get('roles', Roles::class)->middleware('can:Lista de roles')->name('roles');

    Route::get('permisos', Permisos::class)->middleware('can:Lista de permisos')->name('permisos');

    Route::get('usuarios', Usuarios::class)->middleware('can:Lista de usuarios')->name('usuarios');

    Route::get('auditoria', Auditoria::class)->middleware('can:Auditoria')->name('auditoria');

});

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('manual', ManualController::class)->name('manual');
