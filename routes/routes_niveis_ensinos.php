<?php

use App\Http\Controllers\NivelEnsinoController;

//NiveisEnsinos
Route::prefix('niveis_ensinos')->group(function () {
    Route::get('', [NivelEnsinoController::class, 'index'])->name('niveis_ensinos.index');
    Route::get('/create', [NivelEnsinoController::class, 'create'])->name('niveis_ensinos.create');
    Route::post('', [NivelEnsinoController::class, 'store'])->name('niveis_ensinos.store');
    Route::get('/{id}', [NivelEnsinoController::class, 'show'])->name('niveis_ensinos.show');
    Route::get('/{id}/edit', [NivelEnsinoController::class, 'edit'])->name('niveis_ensinos.edit');
    Route::put('/{id}', [NivelEnsinoController::class, 'update'])->name('niveis_ensinos.update');
    Route::delete('/{id}', [NivelEnsinoController::class, 'destroy'])->name('niveis_ensinos.destroy');
    Route::get('/search/{field}/{value}',[NivelEnsinoController::class, 'search'])->name('niveis_ensinos.search');
});
