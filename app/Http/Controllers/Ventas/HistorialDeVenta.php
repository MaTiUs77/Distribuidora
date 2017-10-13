<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\ResumenDetalle;
use App\Http\Controllers\Ventas\Model\VentasModel;

class HistorialDeVenta extends Controller
{
    public function historial()
    {
        $hventas = VentasModel::finalizadas()->paginate(10);
        $resumen = new ResumenDeVenta($hventas);

        $datos = compact('resumen');
        
        return view('ventas.historial',$datos);
    }
}