<?php
Route::get('afip/comprobante/{pto_venta}/{tipo_comprobante}/{nro_comprobante}', 'Api\Afip\AfipApi@comprobante');
Route::get('afip/generar/{pto_venta}/{tipo_comprobante}', 'Api\Afip\AfipApi@generar');
Route::get('afip/forms', 'Api\Afip\AfipApi@forms');
Route::get('afip/custom', 'Api\Afip\AfipApi@custom');


Route::get('afip/persona/{cuil}', 'Api\Afip\AfipApi@persona');
