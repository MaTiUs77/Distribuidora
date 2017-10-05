<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TerminalDeVenta extends Controller
{
    public function iniciar()
    {
        $terminalPendiente = VentasModel::where('origen','TERMINAL')
            ->where('estado','PENDIENTE')->first();

        if($terminalPendiente)
        {
            return redirect(route('venta_detalle.show',$terminalPendiente->id));
        } else {
            $cliente = User::where('email','cfinal@cfinal')->first();

            $nuevaVenta = new VentasModel();
            $nuevaVenta->origen = 'TERMINAL';
            $nuevaVenta->fecha_entrega = Carbon::now();

            $nuevaVenta->estado = 'PENDIENTE';
            $nuevaVenta->user_id = Auth::id();
            $nuevaVenta->cliente_id = $cliente->id;

            $nuevaVenta->save();
            return redirect(route('venta_detalle.show',$nuevaVenta->id));
        }
    }
}