<?php

use App\Http\Controllers\MobileController;
use App\Http\Controllers\MobileEscolaController;
use App\Http\Controllers\MobileNeeController;

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

//Mobile Nees
Route::prefix('mobile_nees')->group(function () {
    Route::get('', [MobileNeeController::class, 'index'])->name('mobile_nees.index');
    Route::get('/create', [MobileNeeController::class, 'create'])->name('mobile_nees.create');
    Route::post('', [MobileNeeController::class, 'store'])->name('mobile_nees.store');
    Route::get('/{id}', [MobileNeeController::class, 'show'])->name('mobile_nees.show');
    Route::get('/{id}/edit', [MobileNeeController::class, 'edit'])->name('mobile_nees.edit');
    Route::put('/{id}', [MobileNeeController::class, 'update'])->name('mobile_nees.update');
    Route::delete('/{id}', [MobileNeeController::class, 'destroy'])->name('mobile_nees.destroy');
    Route::get('/search/{field}/{value}', [MobileNeeController::class, 'search'])->name('mobile_nees.search');
});
