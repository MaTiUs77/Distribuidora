<?php

namespace App\Http\Controllers\Vendedores;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Vendedores\Model\VendedoresModel;
use Illuminate\Http\Request;

class Vendedores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedores = VendedoresModel::all();
        $datos = compact('vendedores');
        return view('vendedores.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new VendedoresModel();
        $newItem->nombre = $request->get('name');
        $newItem->apellido = $request->get('apellido');
        $newItem->telefono = $request->get('telefono');
        $newItem->direccion = $request->get('direccion');
        $newItem->email = $request->get('email');
        $newItem->cuil_cuit = $request->get('cuil_cuit');
        $newItem->user_id = $request->get('user_id');
        $newItem->save();
        return redirect()->route('vendedores.index');
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
        $vendedor = VendedoresModel::findOrFail($id);
        $dato =  compact('vendedor');
        return view('vendedores.edit', $dato);
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
        $vendedor = VendedoresModel::findOrFail($id);
        $vendedor->nombre = $request->get('name');
        $vendedor->apellido = $request->get('apellido');
        $vendedor->telefono = $request->get('telefono');
        $vendedor->direccion = $request->get('direccion');
        $vendedor->email = $request->get('email');
        $vendedor->cuil_cuit = $request->get('cuil_cuit');
        $vendedor->save();
        return redirect()->route('vendedores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor = VendedoresModel::findOrFail($id);
        $vendedor->delete();
        return redirect()->route('vendedores.index')->with('message', 'Vendedor eliminado con exito!');
    }
}
