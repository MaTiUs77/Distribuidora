<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\ResumenDetalle;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Support\Facades\Redis;

class Api extends Controller
{
    public function venta($venta_id)
    {
        $venta = VentasModel::find($venta_id);

        if(isset($venta))
        {
            $detalles = Ventas_DetallesModel::where('venta_id',$venta_id)->get();

            $resumen = new ResumenDetalle($venta, $detalles);

            // Cada vez que se usa este metodo del api, se va a realzar un espejo en REDIS
            Redis::set('venta', json_encode($resumen));
            Redis::publish('venta', json_encode($resumen));

            return compact('resumen');
        } else {
            $error = "La venta no existe";
            return compact('error');
        }
    }

    public function buscarProductoPorCodigo($codigo)
    {
        $producto = ProductosModel::where('barcode',$codigo)->first();

        return compact('producto');
    }

    public function buscarProductoPorNombre($nombre)
    {
        $productos = ProductosModel::where('nombre','like',$nombre.'%')->get();

        return compact('productos');
    }

}
