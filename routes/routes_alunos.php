<?php

use App\Http\Controllers\AlunoController;

//Alunos
Route::prefix('alunos')->group(function () {
    Route::get('', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/create', [AlunoController::class, 'create'])->name('alunos.create');
    Route::post('', [AlunoController::class, 'store'])->name('alunos.store');
    Route::get('/{id}', [AlunoController::class, 'show'])->name('alunos.show');
    Route::get('/{id}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
    Route::put('/{id}', [AlunoController::class, 'update'])->name('alunos.update');
    Route::delete('/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');
    Route::get('/search/{field}/{value}', [AlunoController::class, 'search'])->name('alunos.search');

    Route::get('/extradata/{id}', [AlunoController::class, 'extradata']);
    Route::post('/uploadfoto', [AlunoController::class, 'uploadfoto'])->name('alunos.uploadfoto');

    Route::post('/documento_upload/{documento_upload_descricao}', [AlunoController::class, 'documento_upload'])->name('alunos.documento_upload');
    Route::delete('/deletar_documento/{aluno_documento_id}', [AlunoController::class, 'deletar_documento'])->name('alunos.deletar_documento');
});
