<?php
Route::get('autocomplete/clientes', 'Api\Autocomplete\ListaClientes@autocomplete');
Route::get('autocomplete/productos', 'Api\Autocomplete\ListaProductos@autocomplete');
