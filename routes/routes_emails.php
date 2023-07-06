<?php

use App\Http\Controllers\EnviarEmailController;

//Emails
Route::prefix('enviar_email')->group(function () {
    Route::get('publico_escolas/{nome}/{telefone}/{diretor}/{endereco}/{email}/{motivo}', [EnviarEmailController::class, 'publico_escolas'])->name('enviar_email.publico_escolas');
    Route::get('avaliacoes/avaliacao/{resposta_pergunta_1}/{resposta_pergunta_2}/{resposta_pergunta_3}/{usuario}', [EnviarEmailController::class, 'avaliacoes_avaliacao'])->name('enviar_email.avaliacoes_avaliacao');
    Route::get('users/primeiro_acesso/{email}/{senha}', [EnviarEmailController::class, 'primeiro_acesso'])->name('enviar_email.primeiro_acesso');
});

Route::get('publico_escolas_view', [EnviarEmailController::class, 'publico_escolas_view'])->name('enviar_email.publico_escolas_view');
