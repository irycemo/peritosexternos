<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AvaluoApiController;

Route::middleware('auth:sanctum')->group(function () {

    Route::post('consulta_avaluo', [AvaluoApiController::class, 'consultarAvaluo']);

    Route::post('consulta_avaluo_id', [AvaluoApiController::class, 'consultarAvaluoId']);

    Route::post('reactivar_avaluo', [AvaluoApiController::class, 'reactivarAvaluo']);

    Route::post('operar_avaluo', [AvaluoApiController::class, 'operarAvaluo']);

    Route::post('generar_avaluo_pdf', [AvaluoApiController::class, 'generarPdf']);

    Route::post('generar_avaluo_pdf', [AvaluoApiController::class, 'generarPdf']);

    Route::post('consultar_cartografia', [AvaluoApiController::class, 'consultarCartografia']);

    Route::post('validar_cartografia', [AvaluoApiController::class, 'validarCartografia']);

    Route::post('consultar_avaluos_conciliar', [AvaluoApiController::class, 'consultarAvaluosConciliar']);

    Route::post('conciliar_predio', [AvaluoApiController::class, 'conciliarPredio']);

});
