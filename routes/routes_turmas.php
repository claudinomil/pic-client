<?php

use App\Http\Controllers\TurmaController;

//Turmas
Route::prefix('turmas')->group(function () {
    Route::get('', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/create', [TurmaController::class, 'create'])->name('turmas.create');
    Route::post('', [TurmaController::class, 'store'])->name('turmas.store');
    Route::get('/{id}', [TurmaController::class, 'show'])->name('turmas.show');
    Route::get('/{id}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::put('/{id}', [TurmaController::class, 'update'])->name('turmas.update');
    Route::delete('/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');
    Route::get('/search/{field}/{value}', [TurmaController::class, 'search'])->name('turmas.search');

    Route::get('/extradata/{id}', [TurmaController::class, 'extradata']);
    Route::post('/uploadfoto', [TurmaController::class, 'uploadfoto'])->name('turmas.uploadfoto');
});
