<?php
Route::resource('ventas', 'Ventas\Ventas');
Route::resource('pendientes', 'Ventas\Pendientes');

Route::get('ventas/search/autocomplete', 'Ventas\ListaClientes@autocomplete');
Route::get('ventas/search/autocomplete/producto', 'Ventas\ListaProductos@autocomplete');
