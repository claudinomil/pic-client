<?php

use App\Http\Controllers\EspacoColaboracaoController;

//Espaços Colaborações
Route::prefix('espacos_colaboracoes')->group(function () {
    Route::get('', [EspacoColaboracaoController::class, 'index'])->name('espacos_colaboracoes.index');
    Route::get('/create', [EspacoColaboracaoController::class, 'create'])->name('espacos_colaboracoes.create');
    Route::post('', [EspacoColaboracaoController::class, 'store'])->name('espacos_colaboracoes.store');
    Route::get('/{id}', [EspacoColaboracaoController::class, 'show'])->name('espacos_colaboracoes.show');
    Route::get('/{id}/edit', [EspacoColaboracaoController::class, 'edit'])->name('espacos_colaboracoes.edit');
    Route::put('/{id}', [EspacoColaboracaoController::class, 'update'])->name('espacos_colaboracoes.update');
    Route::delete('/{id}', [EspacoColaboracaoController::class, 'destroy'])->name('espacos_colaboracoes.destroy');
    Route::get('/search/{field}/{value}', [EspacoColaboracaoController::class, 'search'])->name('espacos_colaboracoes.search');
});
