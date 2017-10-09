<?php
Route::get('pendientes', 'Ventas\Pendientes@index')->name('pendientes.index');
Route::get('pendientes/finish/{venta_id}/{terminal?}', 'Ventas\Pendientes@finish')->name('pendientes.finish');

Route::get('historial', 'Ventas\ListaVentas@historialVentas')->name('historial.index');

Route::get('ventas/terminal', 'Ventas\TerminalDeVenta@iniciar')->name('terminal');
Route::get('ventas/search/autocomplete', 'Ventas\ListaClientes@autocomplete');
Route::get('ventas/search/autocomplete/producto', 'Ventas\ListaProductos@autocomplete');

Route::resource('ventas', 'Ventas\Ventas');


