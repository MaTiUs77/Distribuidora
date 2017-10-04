<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\ResumenDetalle;
use App\Http\Controllers\Ventas\Model\VentasModel;

class Api extends Controller
{
    public function venta($venta_id)
    {
        $venta = VentasModel::findOrFail($venta_id);
        $detalles = Ventas_DetallesModel::where('venta_id',$venta_id)->get();

        $resumen = new ResumenDetalle($venta, $detalles);

        return compact('resumen');
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
