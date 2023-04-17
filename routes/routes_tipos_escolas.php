<?php

use App\Http\Controllers\TipoEscolaController;

//TiposEscolas
Route::prefix('tipos_escolas')->group(function () {
    Route::get('', [TipoEscolaController::class, 'index'])->name('tipos_escolas.index');
    Route::get('/create', [TipoEscolaController::class, 'create'])->name('tipos_escolas.create');
    Route::post('', [TipoEscolaController::class, 'store'])->name('tipos_escolas.store');
    Route::get('/{id}', [TipoEscolaController::class, 'show'])->name('tipos_escolas.show');
    Route::get('/{id}/edit', [TipoEscolaController::class, 'edit'])->name('tipos_escolas.edit');
    Route::put('/{id}', [TipoEscolaController::class, 'update'])->name('tipos_escolas.update');
    Route::delete('/{id}', [TipoEscolaController::class, 'destroy'])->name('tipos_escolas.destroy');
    Route::get('/search/{field}/{value}',[TipoEscolaController::class, 'search'])->name('tipos_escolas.search');
});
