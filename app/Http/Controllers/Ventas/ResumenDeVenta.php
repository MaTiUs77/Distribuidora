<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ventas\Model\VentasModel;

class ResumenDeVenta extends Controller
{
    public $venta;

    public $cantidadProductos = 0;
    public $costoTotal = 0;

    public function __construct(VentasModel $venta) {
        $this->venta = $venta;

        $this->calcularCantidadProductos();
        $this->calcularCostoTotal();
    }

    public function calcularCantidadProductos()
    {
        $this->cantidadProductos = $this->venta->cantidad;
    }

    private function calcularCostoTotal()
    {
 //       $costoTotal = 0;

   //     foreach ($this->venta->detalles as $detalle)
     //   {
       //     $costoTotal += $detalle->producto->precio_venta * $detalle->cantidad;
        //}

//        $this->costoTotal = $costoTotal;
    }
}
