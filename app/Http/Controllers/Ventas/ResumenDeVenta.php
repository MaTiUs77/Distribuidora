<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;

class ResumenDeVenta extends Controller
{
    public $ventas;

    public $cantidadProductos = 0;
    public $costoTotal = 0;

    public function __construct($ventas) {
        $this->ventas = $ventas;


        $this->calcularCantidadProductos();
        $this->calcularCostoTotal();
    }

    public function calcularCantidadProductos()
    {
        $this->cantidadProductos = $this->ventas->sum('cantidad');
    }

    private function calcularCostoTotal()
    {
        foreach ($this->ventas as $venta)
        {
            $this->costoTotal += $venta->total;
        }
    }
}
