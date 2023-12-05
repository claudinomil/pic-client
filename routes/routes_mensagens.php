<?php

use App\Http\Controllers\MensagemController;

//Mensagens
Route::prefix('mensagens')->group(function () {
    Route::get('', [MensagemController::class, 'index'])->name('mensagens.index');

    Route::post('/atualizar', [MensagemController::class, 'atualizar'])->name('mensagens.atualizar');

    //Deixa para não dar erro
    Route::post('', [MensagemController::class, 'store'])->name('mensagens.store');
});
