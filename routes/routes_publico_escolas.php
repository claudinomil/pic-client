<?php

use App\Http\Controllers\PublicoEscolaController;

//Escolas
Route::prefix('publico_escolas')->group(function () {
    Route::get('/create', [PublicoEscolaController::class, 'create'])->name('publico_escolas.create');
    Route::post('', [PublicoEscolaController::class, 'store'])->name('publico_escolas.store');
});
