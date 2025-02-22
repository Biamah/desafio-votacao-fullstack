<?php

use App\Http\Controllers\PautaController;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('pautas')->group(function () {
    Route::get('/', [PautaController::class, 'index']);
    Route::post('/', [PautaController::class, 'store']);
    Route::get('/{id}', [PautaController::class, 'show']);
    Route::put('/{id}', [PautaController::class, 'update']);
    Route::delete('/{id}', [PautaController::class, 'destroy']);
});

Route::prefix('sessoes')->group(function () {
    Route::get('/', [SessaoController::class, 'index']);
    Route::post('/', [SessaoController::class, 'store']);
    Route::get('/{id}', [SessaoController::class, 'show']);
    Route::put('/{id}', [SessaoController::class, 'update']);
    Route::delete('/{id}', [SessaoController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
