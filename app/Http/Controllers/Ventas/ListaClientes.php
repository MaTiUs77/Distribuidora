<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Usuarios\Usuarios;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class ListaClientes extends Controller
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
        $clientes = User::role('cliente')
            ->where('name', 'LIKE', '%' . $term . '%')
//            ->orWhere('apellid', 'LIKE', '%'.$term.'%')
            ->take(5)->get();


        foreach ($clientes as $query) {
            $results[] = ['id' => $query->id, 'value' => $query->name];
        }

        return response()->json($results);
    }
}