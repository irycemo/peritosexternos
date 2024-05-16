<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AvaluoApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('consulta_avaluo', [AvaluoApiController::class, 'consultarAvaluo']);

    Route::get('consulta_avaluo_id', [AvaluoApiController::class, 'consultarAvaluoId']);

    Route::get('reactivar_avaluo', [AvaluoApiController::class, 'reactivarAvaluo']);

    Route::get('operar_avaluo', [AvaluoApiController::class, 'operarAvaluo']);

});
