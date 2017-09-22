<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Ventas\Model\VentasModel;
use App\Http\Controllers\Ventas\ResumenDeVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $ventas = VentasModel::where('estado','Pendiente de entrega')->get();

        $resumen  = new ResumenDeVenta($ventas);

        $datos = compact('user','resumen') ;

        return view('home',$datos);
    }
}
