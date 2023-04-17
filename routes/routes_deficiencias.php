<?php

use App\Http\Controllers\DeficienciaController;

//Deficiencias
Route::prefix('deficiencias')->group(function () {
    Route::get('', [DeficienciaController::class, 'index'])->name('deficiencias.index');
    Route::get('/create', [DeficienciaController::class, 'create'])->name('deficiencias.create');
    Route::post('', [DeficienciaController::class, 'store'])->name('deficiencias.store');
    Route::get('/{id}', [DeficienciaController::class, 'show'])->name('deficiencias.show');
    Route::get('/{id}/edit', [DeficienciaController::class, 'edit'])->name('deficiencias.edit');
    Route::put('/{id}', [DeficienciaController::class, 'update'])->name('deficiencias.update');
    Route::delete('/{id}', [DeficienciaController::class, 'destroy'])->name('deficiencias.destroy');
    Route::get('/search/{field}/{value}', [DeficienciaController::class, 'search'])->name('deficiencias.search');
});
