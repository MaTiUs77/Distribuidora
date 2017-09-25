<?php
Route::get('venta_detalle/{venta_id}/api', 'Venta_Detalle\ApiVentaDetalle@api');

Route::resource('venta_detalle', 'Venta_Detalle\Venta_Detalle');

