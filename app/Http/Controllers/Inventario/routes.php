<?php
Route::prefix('inventario')->group(function () {
    Route::get('/', 'Inventario\ImportarInventario@index')
        ->name('inventario.index');

    Route::get('download/{extension}', 'Inventario\ImportarInventario@download')
        ->name('inventario.download');

    Route::post('import', 'Inventario\ImportarInventario@import')
        ->name('inventario.import');
});




