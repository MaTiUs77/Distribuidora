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
        $producto = ProductosModel::find($producto_id);

        $cantidad_actual = $producto->stock;
        $resta = $cantidad_actual - $cantidad;

        $retorno = new \stdClass();
        $retorno->descuentoRealizado = false;

        if($resta >= 0)
        {
            // Ok, el stock es acorde a la cantidad solicitada, se realiza el descuento de inventario
            $producto->stock = $resta;
            $producto->save();

            $retorno->descuentoRealizado = true;
        }

        $retorno->producto = $producto;
        return $retorno;
    }

    public function devolverUnProducto($venta_detalle)
    {
            $p = ProductosModel::findOrFail($venta_detalle->producto_id);
        
            $cantidad_actual = $p->stock;

            $suma = $cantidad_actual + $venta_detalle->cantidad;

            $p->stock = $suma;
            $p->save();


    }
    public function devolverProducto(Collection $venta_detalle)
    {

        foreach ($venta_detalle as $producto)
        {

            $p = ProductosModel::findOrFail($producto->producto_id);
            $cantidad_actual = $p->stock;

            $suma = $cantidad_actual + $producto->cantidad;

            $p->stock = $suma;
            $p->save();

        }

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
