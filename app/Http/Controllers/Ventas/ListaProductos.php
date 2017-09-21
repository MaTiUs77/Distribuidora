<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Usuarios\Usuarios;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class ListaProductos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete()
    {
        $term = Input::get('term');

        $results = array();

        $producto = ProductosModel:: where('nombre', 'LIKE', '%' . $term . '%')
//            ->orWhere('apellid', 'LIKE', '%'.$term.'%')
            ->take(5)->get();


        foreach ($producto as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->nombre, 'precio' => $query->precio_venta];
        }

        return response()->json($results);
    }
}