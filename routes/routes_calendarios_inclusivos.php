<?php

use App\Http\Controllers\CalendarioInclusivoController;

//Calendarios Inclusivos
Route::prefix('calendarios_inclusivos')->group(function () {
    Route::get('', [CalendarioInclusivoController::class, 'index'])->name('calendarios_inclusivos.index');
    Route::get('/create', [CalendarioInclusivoController::class, 'create'])->name('calendarios_inclusivos.create');
    Route::post('', [CalendarioInclusivoController::class, 'store'])->name('calendarios_inclusivos.store');
    Route::get('/{id}', [CalendarioInclusivoController::class, 'show'])->name('calendarios_inclusivos.show');
    Route::get('/{id}/edit', [CalendarioInclusivoController::class, 'edit'])->name('calendarios_inclusivos.edit');
    Route::put('/{id}', [CalendarioInclusivoController::class, 'update'])->name('calendarios_inclusivos.update');
    Route::delete('/{id}', [CalendarioInclusivoController::class, 'destroy'])->name('calendarios_inclusivos.destroy');
    Route::get('/search/{field}/{value}', [CalendarioInclusivoController::class, 'search'])->name('calendarios_inclusivos.search');

    Route::post('/pdf_upload/{pdf_upload_descricao}', [CalendarioInclusivoController::class, 'pdf_upload'])->name('calendarios_inclusivos.pdf_upload');
    Route::delete('/deletar_pdf/{calendario_inclusivo_pdf_id}', [CalendarioInclusivoController::class, 'deletar_pdf'])->name('calendarios_inclusivos.deletar_pdf');
});
