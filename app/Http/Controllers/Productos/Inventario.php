<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class Inventario extends Controller
{
    public function descontarProducto($producto_id,$cantidad)
    {
        $producto = ProductosModel::findOrFail($producto_id);
        $cantidad_actual = $producto->stock;
        $resta = $cantidad_actual - $cantidad;

        if($resta >= 0)
        {
            $producto->stock = $resta;
            $producto->save();

        }
        else
        {
            $retorno = new \stdClass();
            $retorno->done = true;
            $retorno->producto = $producto;
            return $retorno;
        }
    }

    public function devolverProducto($venta_detalle)
    {
        $producto = ProductosModel::findOrFail($venta_detalle->producto_id);
        $cantidad_actual = $producto->stock;
        $suma = $cantidad_actual + $venta_detalle->cantidad;

        $producto->stock = $suma;
        $producto->save();

        return $producto;
    }

    public function actualizarCantidadProducto($venta_detalle, $cantidad_nueva)
    {
        $producto = ProductosModel::findOrFail($venta_detalle->producto_id);
        $cantidad_vieja = $venta_detalle->cantidad;
        $retorno = new \stdClass();
        $retorno->done = false;

        if($cantidad_vieja > $cantidad_nueva)
        {
            $diferencia = $cantidad_vieja - $cantidad_nueva;
            $producto->stock += $diferencia;
            $producto->save();
        }else
        {
          $diferencia  = $cantidad_nueva - $cantidad_vieja;

            $stock = $producto->stock;

            $resta = $stock - $diferencia;
          if($resta < 0)
          {
              $retorno->done = true;
              $retorno->stock = $producto->stock;
              return $retorno;
          }
          else
          {
              $producto->stock = $resta;
              $producto->save();
          }

        }
    }

    public function alertaStock()
    {
        $productosConAlerta = ProductosModel::where('stock','<',DB::raw("`stock_minimo`"))->get();

        return $productosConAlerta;
    }
}
