<?php

use App\Livewire\Admin\Umas;
use Illuminate\Http\Request;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Avaluos;
use App\Livewire\Admin\Permisos;
use App\Livewire\Admin\Usuarios;
use App\Livewire\Admin\Auditoria;
use Illuminate\Support\Facades\Route;
use App\Livewire\Valuacion\MisAvaluos;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ValuacionController;
use App\Http\Controllers\SetPasswordController;
use App\Livewire\Consultas\Preguntas\Preguntas;
use App\Http\Controllers\VerificacionController;
use App\Livewire\Consultas\Preguntas\NuevaPregunta;
use App\Livewire\Consutas\AcuerdosValor\AcuerdosValor;
use App\Http\Controllers\Preguntas\PreguntasController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'esta.activo', 'verified']], function(){

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

    Route::get('acuerdos_valores', AcuerdosValor::class)->name('acuerdos_valores');

    Route::get('preguntas_frecuentes', Preguntas::class)->name('preguntas_frecuentes');

    Route::get('nueva_pregunta/{pregunta?}', NuevaPregunta::class)->middleware('permission:Preguntas')->name('nueva_pregunta');

    Route::post('image-upload', [PreguntasController::class, 'storeImage'])->name('ckImage');

});

Route::get('verificacion/{firma_electronica:uuid}', VerificacionController::class)->name('verificacion');

Route::get('setpassword/{email}', [SetPasswordController::class, 'create'])->name('setpassword');
Route::post('setpassword', [SetPasswordController::class, 'store'])->name('setpassword.store');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');