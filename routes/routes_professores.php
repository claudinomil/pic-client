<?php

use App\Http\Controllers\ProfessorController;

//Professores
Route::prefix('professores')->group(function () {
    Route::get('', [ProfessorController::class, 'index'])->name('professores.index');
    Route::get('/create', [ProfessorController::class, 'create'])->name('professores.create');
    Route::post('', [ProfessorController::class, 'store'])->name('professores.store');
    Route::get('/{id}', [ProfessorController::class, 'show'])->name('professores.show');
    Route::get('/{id}/edit', [ProfessorController::class, 'edit'])->name('professores.edit');
    Route::put('/{id}', [ProfessorController::class, 'update'])->name('professores.update');
    Route::delete('/{id}', [ProfessorController::class, 'destroy'])->name('professores.destroy');
    Route::get('/search/{field}/{value}', [ProfessorController::class, 'search'])->name('professores.search');

    Route::get('/extradata/{id}', [ProfessorController::class, 'extradata']);
    Route::post('/uploadfoto', [ProfessorController::class, 'uploadfoto'])->name('professores.uploadfoto');
});
