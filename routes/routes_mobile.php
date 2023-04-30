<?php

use App\Http\Controllers\MobileController;
use App\Http\Controllers\MobileEscolaController;
use App\Http\Controllers\MobileDeficienciaController;

//Mobile
Route::prefix('mobile')->group(function () {
    Route::get('', [MobileController::class, 'index'])->name('mobile.index');
    Route::get('/create', [MobileController::class, 'create'])->name('mobiles.create');
    Route::post('', [MobileController::class, 'store'])->name('mobiles.store');
    Route::get('/{id}', [MobileController::class, 'show'])->name('mobiles.show');
    Route::get('/{id}/edit', [MobileController::class, 'edit'])->name('mobiles.edit');
    Route::put('/{id}', [MobileController::class, 'update'])->name('mobiles.update');
    Route::delete('/{id}', [MobileController::class, 'destroy'])->name('mobiles.destroy');
    Route::get('/search/{field}/{value}', [MobileController::class, 'search'])->name('mobiles.search');
});

//Mobile Escolas
Route::prefix('mobile_escolas')->group(function () {
    Route::get('', [MobileEscolaController::class, 'index'])->name('mobile_escolas.index');
    Route::get('/create', [MobileEscolaController::class, 'create'])->name('mobile_escolas.create');
    Route::post('', [MobileEscolaController::class, 'store'])->name('mobile_escolas.store');
    Route::get('/{id}', [MobileEscolaController::class, 'show'])->name('mobile_escolas.show');
    Route::get('/{id}/edit', [MobileEscolaController::class, 'edit'])->name('mobile_escolas.edit');
    Route::put('/{id}', [MobileEscolaController::class, 'update'])->name('mobile_escolas.update');
    Route::delete('/{id}', [MobileEscolaController::class, 'destroy'])->name('mobile_escolas.destroy');
    Route::get('/search/{field}/{value}', [MobileEscolaController::class, 'search'])->name('mobile_escolas.search');
});

//Mobile Deficiencias
Route::prefix('mobile_deficiencias')->group(function () {
    Route::get('', [MobileDeficienciaController::class, 'index'])->name('mobile_deficiencias.index');
    Route::get('/create', [MobileDeficienciaController::class, 'create'])->name('mobile_deficiencias.create');
    Route::post('', [MobileDeficienciaController::class, 'store'])->name('mobile_deficiencias.store');
    Route::get('/{id}', [MobileDeficienciaController::class, 'show'])->name('mobile_deficiencias.show');
    Route::get('/{id}/edit', [MobileDeficienciaController::class, 'edit'])->name('mobile_deficiencias.edit');
    Route::put('/{id}', [MobileDeficienciaController::class, 'update'])->name('mobile_deficiencias.update');
    Route::delete('/{id}', [MobileDeficienciaController::class, 'destroy'])->name('mobile_deficiencias.destroy');
    Route::get('/search/{field}/{value}', [MobileDeficienciaController::class, 'search'])->name('mobile_deficiencias.search');
});
