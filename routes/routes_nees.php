<?php

use App\Http\Controllers\NeeController;

//Nees
Route::prefix('nees')->group(function () {
    Route::get('', [NeeController::class, 'index'])->name('nees.index');
    Route::get('/create', [NeeController::class, 'create'])->name('nees.create');
    Route::post('', [NeeController::class, 'store'])->name('nees.store');
    Route::get('/{id}', [NeeController::class, 'show'])->name('nees.show');
    Route::get('/{id}/edit', [NeeController::class, 'edit'])->name('nees.edit');
    Route::put('/{id}', [NeeController::class, 'update'])->name('nees.update');
    Route::delete('/{id}', [NeeController::class, 'destroy'])->name('nees.destroy');
    Route::get('/search/{field}/{value}', [NeeController::class, 'search'])->name('nees.search');

    Route::post('/documento_upload/{documento_upload_descricao}', [NeeController::class, 'documento_upload'])->name('nees.documento_upload');
    Route::delete('/deletar_documento/{nee_documento_id}', [NeeController::class, 'deletar_documento'])->name('nees.deletar_documento');
});
