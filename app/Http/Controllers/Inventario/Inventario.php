<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;


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

    public function devolverProducto(Ventas_DetallesModel $detalle)
    {
        $producto = ProductosModel::findOrFail($detalle->producto_id);
        $cantidad_actual = $producto->stock;

        $suma = $cantidad_actual + $detalle->cantidad;

        $producto->stock = $suma;
        $producto->save();

        return $producto;
    }

    public function devolverProductosMultiples(Collection $detalleCollection)
    {
        foreach ($detalleCollection as $detalle)
        {
            $this->devolverProducto($detalle);
        }

        return true;
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
}
