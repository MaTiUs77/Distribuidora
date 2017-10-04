<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\ResumenDetalle;
use App\Http\Controllers\Ventas\Model\VentasModel;

class ApiTerminal extends Api
{
    /**
     * La terminal solicita ingresar un codigo a la lista de productos de la factura
     *
     * @param $codigo
     */
    public function addCodigo($codigo)
    {
        $producto = ProductosModel::where('barcode',$codigo)->first();
        
        

        return compact('producto');
    }
}
