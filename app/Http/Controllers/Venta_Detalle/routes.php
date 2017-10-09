<?php
Route::resource('venta_detalle', 'Venta_Detalle\Venta_Detalle');
Route::get('venta_detalle/historial/{venta_id}', 'Ventas\ListaVentas@historialVentaDetalles')->name('venta_detalle.historial');


