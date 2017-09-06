<?php
Route::get('carrito', 'Carrito\Carrito@lista');
Route::get('carrito/destroy', 'Carrito\Carrito@destroy');
Route::get('carrito/{producto}/{qty}', 'Carrito\Carrito@add')->name('carrito.add');
