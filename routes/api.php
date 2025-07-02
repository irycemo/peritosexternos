<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AvaluoApiController;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('consulta_avaluo', [AvaluoApiController::class, 'consultarAvaluo']);

    Route::post('consulta_avaluo_id', [AvaluoApiController::class, 'consultarAvaluoId']);

    Route::post('reactivar_avaluo', [AvaluoApiController::class, 'reactivarAvaluo']);

    Route::post('operar_avaluo', [AvaluoApiController::class, 'operarAvaluo']);

});
