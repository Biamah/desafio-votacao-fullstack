<?php

use App\Http\Controllers\PautaController;
use App\Http\Controllers\SessaoController;
use Illuminate\Support\Facades\Route;

// Rotas para a entidade Pauta
Route::prefix('pautas')->group(function () {
    Route::get('/', [PautaController::class, 'index']);          
    Route::post('/', [PautaController::class, 'store']);         
    Route::get('/{id}', [PautaController::class, 'show']);       
    Route::put('/{id}', [PautaController::class, 'update']);    
    Route::delete('/{id}', [PautaController::class, 'destroy']); 
});

// Rotas para a entidade Sessao
Route::prefix('sessoes')->group(function () {
    Route::get('/', [SessaoController::class, 'index']);          
    Route::post('/', [SessaoController::class, 'store']);         
    Route::get('/{id}', [SessaoController::class, 'show']);       
    Route::put('/{id}', [SessaoController::class, 'update']);     
    Route::delete('/{id}', [SessaoController::class, 'destroy']); 
});
