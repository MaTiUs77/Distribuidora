<?php

namespace App\Http\Controllers\Proveedores;

use App\Http\Controllers\Proveedores\Model\ProveedoresModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Proveedores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = ProveedoresModel::all();
        $datos = compact('proveedores');
        return view('proveedores.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new ProveedoresModel();
        $newItem->nombre = $request->get('name');
        $newItem->telefono = $request->get('telefono');
        $newItem->direccion = $request->get('direccion');
        $newItem->email = $request->get('email');
        $newItem->save();
        return redirect()->route('proveedores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('Formulario para ver detalles del proveedor',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('proveedores.edit', ['proveedores' => ProveedoresModel::findOrFail($id)]);
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
        $proveedores = ProveedoresModel::findOrFail($id);
        $proveedores->nombre = $request->get('name');
        $proveedores->telefono = $request->get('telefono');
        $proveedores->direccion = $request->get('direccion');
        $proveedores->email = $request->get('email');
        $proveedores->save();
        return redirect()->route('proveedores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedores = ProveedoresModel::findOrFail($id);
        $proveedores->delete();
        return redirect()->route('proveedores.index')->with('message', 'Proveedor eliminado con exito!');
    }
}
