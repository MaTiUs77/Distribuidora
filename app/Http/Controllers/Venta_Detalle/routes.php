<?php
Route::resource('venta_detalle', 'Venta_Detalle\Venta_Detalle');
Route::get('venta_detalle/historial/{venta_id}', 'Venta_Detalle\HistorialDeDetalle@historial')->name('venta_detalle.historial');


