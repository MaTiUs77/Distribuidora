<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Inventario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function descontarProducto($id, $cantidad)
    {
//        dd($id,$cantidad);
        $producto = ProductosModel::findOrFail($id);
        $cantidad_actual = $producto->stock;
        $resta = $cantidad_actual - $cantidad;

        $retorno = new \stdClass();
        $retorno->done = false;
        $retorno->producto = $producto;

        if($resta >= 0)
        {
            $producto->stock = $resta;
            $producto->save();

            $retorno->done = true;
            $retorno->producto = $producto;
        }

        return $retorno;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
