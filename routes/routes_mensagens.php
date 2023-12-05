<?php

use App\Http\Controllers\MensagemController;

//Mensagens
Route::prefix('mensagens')->group(function () {
    Route::get('', [MensagemController::class, 'index'])->name('mensagens.index');
    Route::get('/create', [MensagemController::class, 'create'])->name('mensagens.create');
    Route::post('', [MensagemController::class, 'store'])->name('mensagens.store');
    Route::get('/{id}', [MensagemController::class, 'show'])->name('mensagens.show');
    Route::get('/{id}/edit', [MensagemController::class, 'edit'])->name('mensagens.edit');
    Route::put('/{id}', [MensagemController::class, 'update'])->name('mensagens.update');
    Route::delete('/{id}', [MensagemController::class, 'destroy'])->name('mensagens.destroy');
    Route::get('/search/{field}/{value}', [MensagemController::class, 'search'])->name('mensagens.search');
});
