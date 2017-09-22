<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;

class Pendientes extends Controller
{
    public function index()
    {
        $ventasPendientes = VentasModel::where('estado','Pendiente de entrega')->get();

        $resumen = new ResumenDeVenta($ventasPendientes );

        $datos = compact('resumen');
        return view('ventas.pendientes',$datos);
    }
}
