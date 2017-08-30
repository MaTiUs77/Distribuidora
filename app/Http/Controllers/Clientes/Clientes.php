<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Clientes\Model\ClientesModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Clientes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = ClientesModel::all();
        $datos = compact('clientes');
        return view('clientes.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new ClientesModel();
        $newItem->nombre = $request->get('name');
        $newItem->telefono = $request->get('telefono');
        $newItem->direccion = $request->get('direccion');
        $newItem->email = $request->get('email');
        $newItem->cuil_cuit = $request->get('cuil_cuit');
        $newItem->save();
        return redirect()->route('clientes.index');
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
        $cliente = ClientesModel::findOrFail($id);
        $dato =  compact('cliente');
        return view('clientes.edit', $dato);
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
        $cliente = ClientesModel::findOrFail($id);
        $cliente->nombre = $request->get('name');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->email = $request->get('email');
        $cliente->cuil_cuit = $request->get('cuil_cuit');
        $cliente->save();
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = ClientesModel::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('message', 'Cliente eliminado con exito!');
    }
}
