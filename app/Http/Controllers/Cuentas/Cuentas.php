<?php

namespace App\Http\Controllers\Cuentas;

use App\Http\Controllers\Cuentas\Model\CuentasModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Cuentas extends Controller
{
    public function index()
    {
        $cuentas = CuentasModel::paginate(10);

        $datos = compact('cuentas');
        return view('cuentas.index',$datos);
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $newItem = new CuentasModel();
        $newItem->tipo = $request->get('tipo');
        $newItem->nombre = $request->get('nombre');
        $newItem->save();
        return redirect()->route('cuentas.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cuenta = CuentasModel::findOrFail($id);
        $dato = compact('cuenta');
        return view('cuentas.edit', $dato);

    }

    public function update(Request $request, $id)
    {
        $cuenta = CuentasModel::findOrFail($id);
        $cuenta->tipo= $request->get('cuenta');
        $cuenta->nombre = $request->get('name');
        $cuenta->save();
        return redirect()->route('cuentas.index');
    }

    public function destroy($id)
    {
        $cuentas = CuentasModel::findOrFail($id);
        $cuentas->delete();
        return redirect()->route('cuenas.index')->with('message', 'Cuenta eliminada con exito!');
    }
}
