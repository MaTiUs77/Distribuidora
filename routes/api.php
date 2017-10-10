<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/venta/{venta_id}', 'Api\Api@venta');
Route::get('/buscarProductoPorCodigo/{codigo}', 'Api\Api@buscarProductoPorCodigo');
Route::get('/buscarProductoPorNombre/{nombre}', 'Api\Api@buscarProductoPorNombre');

Route::get('/terminal/add/{venta_id}/{cantidad}/{codigo}', 'Api\ApiTerminal@addCodigo');
Route::get('/terminal/remove/{detalle_id}', 'Api\ApiTerminal@removeDetalle');
