<?php

use App\Http\Controllers\PautaController;
use Illuminate\Support\Facades\Route;

// Rotas para a entidade Pauta
Route::prefix('pautas')->group(function () {
    Route::get('/', [PautaController::class, 'index']);          // Listar todas as pautas
    Route::post('/', [PautaController::class, 'store']);         // Criar uma nova pauta
    Route::get('/{id}', [PautaController::class, 'show']);       // Buscar uma pauta específica
    Route::put('/{id}', [PautaController::class, 'update']);     // Atualizar uma pauta
    Route::delete('/{id}', [PautaController::class, 'destroy']); // Deletar uma pauta
});
