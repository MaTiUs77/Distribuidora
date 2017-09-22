<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;

class Pendientes extends Controller
{
    public function index()
    {
        $ventasPendientes = VentasModel::where('estado','Pendiente de entrega')->get();

        $pendientes = array();
        foreach ($ventasPendientes as $venta )
        {
            $resumen = new ResumenDeVenta($venta);

            $pendientes[] = $resumen;
        }

        $datos = compact('pendientes');
        return view('ventas.pendientes',$datos);
    }
}
