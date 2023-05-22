<?php

use App\Http\Controllers\AvaliacaoController;

//Avaliacoes
Route::prefix('avaliacoes')->group(function () {
    Route::get('', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');
    Route::get('/create', [AvaliacaoController::class, 'create'])->name('avaliacoes.create');
    Route::post('', [AvaliacaoController::class, 'store'])->name('avaliacoes.store');
    Route::get('/{id}', [AvaliacaoController::class, 'show'])->name('avaliacoes.show');
    Route::get('/{id}/edit', [AvaliacaoController::class, 'edit'])->name('avaliacoes.edit');
    Route::put('/{id}', [AvaliacaoController::class, 'update'])->name('avaliacoes.update');
    Route::delete('/{id}', [AvaliacaoController::class, 'destroy'])->name('avaliacoes.destroy');
    Route::get('/search/{field}/{value}', [AvaliacaoController::class, 'search'])->name('avaliacoes.search');

    //Avaliações - Entrar direto no Create''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
    Route::get('/avaliar/user', [AvaliacaoController::class, 'avaliar_user'])->name('avaliacoes.avaliar_user');
    //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
});
