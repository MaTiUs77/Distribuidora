<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class Inventario extends Controller
{
    public function descontarProducto($id, $cantidad)
    {
        $producto = ProductosModel::findOrFail($id);
        $cantidad_actual = $producto->stock;
        $resta = $cantidad_actual - $cantidad;

        $retorno = new \stdClass();
        $retorno->done = false;
        $retorno->producto = $producto;

        if($resta >= 0)
        {
            $producto->stock = $resta;
            $producto->save();

            $retorno->done = true;
            $retorno->producto = $producto;
        }

        return $retorno;
    }

    public function alertaStock()
    {
        $productosConAlerta = ProductosModel::where('stock','<',DB::raw("`stock_minimo`"))->get();

        return $productosConAlerta;
    }
}
