<?php

namespace App\Http\Controllers\Carrito;

use App\Http\Controllers\Carrito\CarritoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;

class Carrito extends Controller
{
    public static function lista()
    {
        return request()->session()->get('cart');
    }

    public static function add($id_producto,$unidades)
    {
      $producto = ProductosModel::find($id_producto);

      $producto->unidades = $unidades;

      request()->session()->push('cart',$producto);
      request()->session()->save();

      return redirect(route('productos.index'));

      return request()->session()->get('cart');
    }

    public static function destroy()
    {
        request()->session()->forget('cart');
        request()->session()->save();

        return request()->session()->get('cart');
    }
}
