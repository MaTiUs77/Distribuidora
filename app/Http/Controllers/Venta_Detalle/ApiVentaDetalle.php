<?php

namespace App\Http\Controllers\Venta_Detalle;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Ventas\Model\VentasModel;

class ApiVentaDetalle extends Controller
{
    public function resumen($venta_id)
    {
        $venta = VentasModel::findOrFail($venta_id);
        $detalles = Ventas_DetallesModel::where('venta_id',$venta_id)->get();

        $resumen = new ResumenDetalle($venta, $detalles);

        $datos = compact('resumen');

        return $datos;
    }
}
