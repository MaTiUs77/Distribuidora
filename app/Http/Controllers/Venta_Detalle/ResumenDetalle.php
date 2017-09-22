<?php

namespace App\Http\Controllers\Venta_Detalle;

use App\Http\Controllers\Controller;

class ResumenDetalle extends Controller
{
    public $venta;
    public $detalles;

    public $cantidadProductos = 0;
    public $costoTotal = 0;

    public function __construct($venta, $detalles) {
        $this->venta = $venta;
        $this->detalles = $detalles;

        $this->calcularCantidadProductos();
        $this->calcularCostoTotal();
    }

    public function calcularCantidadProductos()
    {
        $this->cantidadProductos = $this->detalles->sum('cantidad');
    }

    private function calcularCostoTotal()
    {
        foreach ($this->detalles as $detalle)
        {
            $costoTotal = $detalle->producto->precio_venta * $detalle->cantidad;

            $detalle->costoTotal = $costoTotal;

            $this->costoTotal += $costoTotal;
        }

        if(
            $this->venta->total != $this->costoTotal &&
            $this->venta->cantidad != $this->cantidadProductos
        )
        {
            $this->venta->cantidad = $this->cantidadProductos;
            $this->venta->total = $this->costoTotal;
            $this->venta->save();
        }
    }
}
