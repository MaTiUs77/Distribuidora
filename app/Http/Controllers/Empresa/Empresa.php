<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Empresa\Model\EmpresaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Empresa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = EmpresaModel::paginate(10);

        $datos = compact('empresa');
        return view('empresa.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new EmpresaModel();
        $newItem->nombre = $request->get('nombre');
        $newItem->razon_social = $request->get('razon_social');
        $newItem->domicilio_comercial = $request->get('domicilio_comercial');
        $newItem->telefono = $request->get('telefono');
        $newItem->cuit = $request->get('cuit');
        $newItem->email = $request->get('email');
        $newItem->save();
        return redirect()->route('empresa.index');
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
        $empresa = EmpresaModel::findOrFail($id);
        $dato = compact('empresa');
        return view('empresa.edit', $dato);
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
        $empresa = EmpresaModel::findOrFail($id);
        $empresa->nombre = $request->get('nombre');
        $empresa->razon_social = $request->get('razon_social');
        $empresa->domicilio_comercial = $request->get('domicilio_comercial');
        $empresa->telefono = $request->get('telefono');
        $empresa->cuit = $request->get('cuit');
        $empresa->email = $request->get('email');
        $empresa->save();
        return redirect()->route('empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = EmpresaModel::findOrFail($id);
        $empresa->delete();
        return redirect()->route('empresa.index')->with('message', 'Empresa eliminada con exito!');
    }
}
