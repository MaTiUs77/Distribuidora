<?php

namespace App\Http\Controllers\Api\Autocomplete;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\User;
use Illuminate\Support\Facades\Input;

class ListaProductos extends Controller
{
    public function autocomplete()
    {
        $results = array();
        $barcode = null;

        $term = Input::get('term');

        if(is_numeric($term)) {
            $barcode = $term;
        }

        if($barcode) {
            $producto = ProductosModel:: where('barcode',$barcode)->get();
        } else {
            $producto = ProductosModel:: where('nombre', 'LIKE', '%' . $term . '%')->take(5)->get();
        }

        if(count($producto)) {

            foreach ($producto as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->nombre, 'precio' => $query->precio_venta];
            }
        }

        return response()->json($results);
    }
}