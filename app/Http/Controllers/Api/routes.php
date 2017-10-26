<?php
Route::get('/venta/{venta_id}', 'Api\Api@venta');

Route::get('/buscarProductoPorCodigo/{codigo}', 'Api\Api@buscarProductoPorCodigo');
Route::get('/buscarProductoPorNombre/{nombre}', 'Api\Api@buscarProductoPorNombre');

Route::get('/terminal/add/{venta_id}/{cantidad}/{codigo}', 'Api\ApiTerminal@addCodigo');
Route::get('/terminal/remove/{detalle_id}', 'Api\ApiTerminal@removeDetalle');
Route::get('/terminal/resumen/{venta_id}', 'Api\Api@venta');
Route::get('/terminal/reset/{venta_id}', 'Api\ApiTerminal@resetVenta');

