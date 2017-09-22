<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;

class Pendientes extends Controller
{
    public function index()
    {
        $ventasPendientes = VentasModel::where('estado','Pendiente de entrega')->get();

        $resumen = new ResumenDeVenta($ventasPendientes );

        $datos = compact('resumen');
        return view('ventas.pendientes',$datos);
    }

    public function update(Request $request,$id)
    {
       $finalizarVenta = VentasModel::findOrFail($id);
       $finalizarVenta->estado = "Finalizado";
       $finalizarVenta->save();
        return redirect(route('pendientes.index'));
    }
}
