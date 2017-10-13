<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Usuarios\Usuarios;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class ListaProductos extends Controller
{
    public static function cantidadTotal(Collection $ventaDetalle)
    {
        return $ventaDetalle->sum('cantidad');
    }

    public static function costoTotal(Collection $ventaDetalle)
    {
        $total = 0;
        foreach($ventaDetalle as $detalle)
        {
            $total += $detalle->productos->sum('precio_venta');
        }

        return $total;
    }
}