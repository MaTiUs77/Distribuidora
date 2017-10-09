<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\ResumenDetalle;
use App\Http\Controllers\Ventas\Model\VentasModel;

class ListaVentas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function historialVentas()
    {
        $hventas = VentasModel::where('estado','FINALIZADO')->get();
        $resumen = new ResumenDeVenta($hventas);

        $datos = compact('resumen');
        
        return view('ventas.historial',$datos);

    }

    public function historialVentaDetalles($venta_id)
    {
        $venta = VentasModel::findOrFail($venta_id);
        $detalles = Ventas_DetallesModel::where('venta_id',$venta_id)->get();

        $resumen = new ResumenDetalle($venta, $detalles);

        $datos = compact('venta','resumen');
        return view('venta_detalle.historial',$datos);

    }
}