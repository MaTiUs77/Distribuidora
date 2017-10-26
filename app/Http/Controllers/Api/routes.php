<?php


Route::get('/venta/{venta_id}', 'Api\Api@venta');

Route::get('/buscarProductoPorCodigo/{codigo}', 'Api\Api@buscarProductoPorCodigo');
Route::get('/buscarProductoPorNombre/{nombre}', 'Api\Api@buscarProductoPorNombre');


Route::prefix('terminal')->group(function () {
    Route::get('/resumen/{venta_id}', 'Api\Api@venta');

    Route::get('/add/{venta_id}/{cantidad}/{codigo}', 'Api\ApiTerminal@addCodigo');
    Route::get('/remove/{detalle_id}', 'Api\ApiTerminal@removeDetalle');
    Route::get('/reset/{venta_id}', 'Api\ApiTerminal@resetVenta');
});



