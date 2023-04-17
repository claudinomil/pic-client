<?php

use App\Http\Controllers\EscolaController;

//Escolas
Route::prefix('escolas')->group(function () {
    Route::get('', [EscolaController::class, 'index'])->name('escolas.index');
    Route::get('/create', [EscolaController::class, 'create'])->name('escolas.create');
    Route::post('', [EscolaController::class, 'store'])->name('escolas.store');
    Route::get('/{id}', [EscolaController::class, 'show'])->name('escolas.show');
    Route::get('/{id}/edit', [EscolaController::class, 'edit'])->name('escolas.edit');
    Route::put('/{id}', [EscolaController::class, 'update'])->name('escolas.update');
    Route::delete('/{id}', [EscolaController::class, 'destroy'])->name('escolas.destroy');
    Route::get('/search/{field}/{value}', [EscolaController::class, 'search'])->name('escolas.search');
});
