<?php

namespace App\Http\Controllers\Api\Autocomplete;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Input;

class ListaClientes extends Controller
{
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