<?php
Route::get('datatable/marcas', 'Api\Datatable\Datatable@marcas');
Route::get('datatable/categorias', 'Api\Datatable\Datatable@categorias');
Route::get('datatable/almacenes', 'Api\Datatable\Datatable@almacenes');

Route::get('datatable/proveedores', 'Api\Datatable\Datatable@proveedores');
