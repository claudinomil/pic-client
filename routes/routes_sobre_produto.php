<?php

use App\Http\Controllers\SobreProdutoController;

//Sobre Produto
Route::prefix('sobre_produto')->group(function () {
    Route::get('', [SobreProdutoController::class, 'index'])->name('sobre_produto.index');
    //Route::get('/create', [SobreProdutoController::class, 'create'])->name('sobre_produto.create'); //Só para não dar erro no script
    Route::post('', [SobreProdutoController::class, 'store'])->name('sobre_produto.store'); //Só para não dar erro no script
    //Route::get('/{id}', [SobreProdutoController::class, 'show'])->name('sobre_produto.show'); //Só para não dar erro no script
    Route::get('/{id}/edit', [SobreProdutoController::class, 'edit'])->name('sobre_produto.edit');
    Route::put('/{id}', [SobreProdutoController::class, 'update'])->name('sobre_produto.update');
    //Route::delete('/{id}', [SobreProdutoController::class, 'destroy'])->name('sobre_produto.destroy'); //Só para não dar erro no script
    //Route::get('/search/{field}/{value}', [SobreProdutoController::class, 'search'])->name('sobre_produto.search'); //Só para não dar erro no script
});
