<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;

class Pendientes extends Controller
{
    public function index()
    {
        $pendientes = VentasModel::where('estado','Pendiente de entrega')->get();
        $datos = compact('pendientes');
        return view('ventas.pendientes',$datos);
    }
}
