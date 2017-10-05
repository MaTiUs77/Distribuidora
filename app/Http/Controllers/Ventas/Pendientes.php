<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;

class Pendientes extends Controller
{
    public function index()
    {
        $ventasPendientes = VentasModel::where('estado','PENDIENTE')->get();

        $resumen = new ResumenDeVenta($ventasPendientes );

        $datos = compact('resumen');
        return view('ventas.pendientes',$datos);
    }

    public function finish($venta_id,$toTerminal=null)
    {
        $finalizarVenta = VentasModel::findOrFail($venta_id);

        if($finalizarVenta->detalles->count() == 0)
        {
            $finalizarVenta->delete();
        } else {
            $finalizarVenta->estado = "FINALIZADO";
            $finalizarVenta->save();
        }

        if($toTerminal)
        {
            return redirect(route('terminal'));
        } else
        {
            return redirect(route('pendientes.index'));
        }
    }
}
