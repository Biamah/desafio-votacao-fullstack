<?php

use App\Http\Controllers\PautaController;
use App\Http\Controllers\SessaoController;
use Illuminate\Support\Facades\Route;

// Rotas para a entidade Pauta
Route::prefix('pautas')->group(function () {
    Route::get('/', [PautaController::class, 'index']);          // Listar todas as pautas
    Route::post('/', [PautaController::class, 'store']);         // Criar uma nova pauta
    Route::get('/{id}', [PautaController::class, 'show']);       // Buscar uma pauta específica
    Route::put('/{id}', [PautaController::class, 'update']);     // Atualizar uma pauta
    Route::delete('/{id}', [PautaController::class, 'destroy']); // Deletar uma pauta
});

// Rotas para a entidade Sessao
Route::prefix('sessoes')->group(function () {
    Route::get('/', [SessaoController::class, 'index']);          // Listar todas as sessões
    Route::post('/', [SessaoController::class, 'store']);         // Criar uma nova sessão
    Route::get('/{id}', [SessaoController::class, 'show']);       // Buscar uma sessão específica
    Route::put('/{id}', [SessaoController::class, 'update']);     // Atualizar uma sessão
    Route::delete('/{id}', [SessaoController::class, 'destroy']); // Deletar uma sessão
});
