<?php

use App\Http\Controllers\MensagemController;

//Mensagens
Route::prefix('mensagens')->group(function () {
    Route::get('', [MensagemController::class, 'index'])->name('mensagens.index');

    Route::post('/atualizar', [MensagemController::class, 'atualizar'])->name('mensagens.atualizar');
    Route::get('/gravar_como_lida/{id}', [MensagemController::class, 'gravar_como_lida'])->name('mensagens.gravar_como_lida');




//    Route::get('/ultimas_conversas', [MensagemController::class, 'ultimas_conversas'])->name('mensagens.ultimas_conversas');
//    Route::post('/enviar_mensagem', [MensagemController::class, 'enviar_mensagem'])->name('mensagens.enviar_mensagem');
//    Route::get('/conversas/{remetente_user_id}/{destinatario_user_id}', [MensagemController::class, 'conversas'])->name('mensagens.conversas');





    Route::post('', [MensagemController::class, 'store'])->name('mensagens.store');


//    Route::get('/create', [MensagemController::class, 'create'])->name('mensagens.create');
//
//    Route::get('/{id}', [MensagemController::class, 'show'])->name('mensagens.show');
//    Route::get('/{id}/edit', [MensagemController::class, 'edit'])->name('mensagens.edit');
//    Route::put('/{id}', [MensagemController::class, 'update'])->name('mensagens.update');
//    Route::delete('/{id}', [MensagemController::class, 'destroy'])->name('mensagens.destroy');
//    Route::get('/search/{field}/{value}', [MensagemController::class, 'search'])->name('mensagens.search');



});
