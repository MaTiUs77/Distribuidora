<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Ventas\Model\VentasModel;
use App\Http\Controllers\Ventas\ResumenDeVenta;
use Illuminate\Support\Facades\Auth;

class VueController extends Controller
{
    public function index()
    {
        return view('vue');
    }
}
