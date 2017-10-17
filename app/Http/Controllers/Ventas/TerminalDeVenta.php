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
            ->where('estado','A COBRAR')->first();

        if($terminalPendiente)
        {
            return redirect(route('venta_detalle.show',$terminalPendiente->id));
        } else {

            // Genera automaticamente una terminal de venta para un cliente final
            $cliente = User::where('email','cfinal@cfinal')->first();

            $nuevaVenta = new VentasModel();
            $nuevaVenta->user_id = Auth::id();
            $nuevaVenta->cliente_id = $cliente->id;

            $nuevaVenta->origen = 'TERMINAL';

            $nuevaVenta->estado = 'A COBRAR';

            $nuevaVenta->fecha_emision = Carbon::now();
            $nuevaVenta->fecha_vencimiento = Carbon::now();

            $nuevaVenta->save();

            return redirect(route('venta_detalle.show',$nuevaVenta->id));
        }
    }
}