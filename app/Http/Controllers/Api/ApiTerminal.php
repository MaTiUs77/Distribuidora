<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Inventario\Inventario;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Ventas\Model\VentasModel;

class ApiTerminal extends Api
{
    /**
     * La terminal solicita ingresar un codigo a la lista de productos de la factura
     *
     * @param $codigo
     */
    public function addCodigo($venta_id,$cantidad,$codigo)
    {
        $venta = VentasModel::find($venta_id);

        if(isset($venta))
        {
            // La venta existe, busco si existe el producto..
            $producto = ProductosModel::where('barcode',$codigo)->first();

            if(isset($producto))
            {
                $inv = new Inventario();
                $inventario = $inv->descontarProducto($producto->id,$cantidad);

                if($inventario->descuentoRealizado)
                {
                    $newventa = new Ventas_DetallesModel();
                    $newventa->venta_id = $venta->id;
                    $newventa->producto_id = $producto->id;
                    $newventa->cantidad = $cantidad;
                    $newventa->save();

                    // Al llamar al api venta se realiza un nuevo resumen de la venta, y se propaga por redis

                    $response = $this->venta($venta_id);
                    return $response;
                } else {
                    $error = 'El producto "'.$producto->nombre.'" no tiene stock';
                    return compact('error','inventario');
                }
            } else
            {
                $error = 'El codigo no existe';
                return compact('error');
            }

        } else
        {
            $error = 'La venta no existe';
            return compact('error');
        }
    }

    public function removeDetalle(Ventas_DetallesModel $detalle_id)
    {
        $detalle = $detalle_id;

        if(isset($detalle))
        {
            $inv = new Inventario();
            $inventario = $inv->devolverProducto($detalle);

            $detalle->delete();

            $response = $this->venta($detalle->venta_id);
            return $response;

        } else
        {
            $error = 'La venta no existe';
            return compact('error');
        }
    }

    public function resetVenta($venta_id)
    {
        $venta = VentasModel::find($venta_id);

        if(isset($venta))
        {
            $inv = new Inventario();
            // Devuelve y elimina el producto de la venta
            $inv->devolverProductosMultiples($venta->detalles,true);

            $response = $this->venta($venta->id);
            return $response;
        } else  {
            $error = 'La venta no existe';
            return compact('error');
        }
    }
}
