<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;

class ResumenDeVenta extends Controller
{
    public $estado;
    public $costoTotal = 0;
    public $productosTotal = 0;
    public $venta;

    public function _construct(VentasModel $venta)
    {
        $this->venta = VentasModel::find($venta->id)->first();

        dd($this->venta);

        $this->calcularCostoTotal();
    }

    private function calcularCostoTotal()
    {
        $this->costoTotal = $this->venta->detalle->sum('cantidad');
    }
}
