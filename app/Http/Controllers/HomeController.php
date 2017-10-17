<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Ventas\Model\VentasModel;
use App\Http\Controllers\Ventas\ResumenDeVenta;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $ventasPendientes = VentasModel::pendientes()->get();
        $ventasFinalizadas = VentasModel::finalizadas()->get();

        $resumenPendiente  = new ResumenDeVenta($ventasPendientes);
        $resumenFinalizada  = new ResumenDeVenta($ventasFinalizadas);

        $alertaStock = ProductosModel::conAlertaStock()->get();

        $datos = compact('user','resumenPendiente','resumenFinalizada','alertaStock') ;

        return view('home',$datos);
    }
}
