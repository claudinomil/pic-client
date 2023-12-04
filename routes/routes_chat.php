<?php

use App\Http\Controllers\ChatController;

//Chat
Route::prefix('chat')->group(function () {
    Route::get('/usuario_logado', [ChatController::class, 'usuario_logado'])->name('chat.usuario_logado');
    Route::get('/novas_conversas', [ChatController::class, 'novas_conversas'])->name('chat.novas_conversas');
    Route::get('/ultimas_conversas', [ChatController::class, 'ultimas_conversas'])->name('chat.ultimas_conversas');
    Route::get('/conversas/{remetente_user_id}/{destinatario_user_id}', [ChatController::class, 'conversas'])->name('chat.conversas');
    Route::post('/enviar_mensagem', [ChatController::class, 'enviar_mensagem'])->name('chat.enviar_mensagem');
    Route::get('/gravar_como_lida/{id}', [ChatController::class, 'gravar_como_lida'])->name('chat.gravar_como_lida');
    Route::get('/gravar_como_recebidas', [ChatController::class, 'gravar_como_recebidas'])->name('chat.gravar_como_recebidas');
});
