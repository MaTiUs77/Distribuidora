<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;

class Pendientes extends Controller
{
    public function index()
    {
        $pendientes = VentasModel::where('estado','Pendiente de entrega')->get();

        $resumen = array();
        foreach ($pendientes as $pendiente )
        {
            $resumen[] = new ResumenDeVenta($pendiente);
        }

        $datos = compact('resumen');
        return view('ventas.pendientes',$datos);
    }
}
