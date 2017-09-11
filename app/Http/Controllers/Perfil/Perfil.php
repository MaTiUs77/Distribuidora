<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Perfil extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = PerfilModel::find(Auth::id());
        if($perfil == null){
            return view('perfil.create');
        }else{
            $datos = compact('perfil');
            return view('perfil.index',$datos);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perfil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevoPerfil = new PerfilModel();
        $nuevoPerfil->nombre = $request->get('name');
        $nuevoPerfil->apellido = $request->get('apellido');
        $nuevoPerfil->telefono = $request->get('telefono');
        $nuevoPerfil->direccion = $request->get('direccion');
        $nuevoPerfil->email = $request->get('email');
        $nuevoPerfil->cuil_cuit = $request->get('cuit_cuil');
        $nuevoPerfil->user_id= Auth::id();
        $nuevoPerfil->save();
        return redirect()->route('perfil.index');
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
        $perfil = PerfilModel::findOrFail($id);
        $datos = compact('perfil');
        return view('perfil.edit',$datos);
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
        $perfil = PerfilModel::findOrFail($id);
        $perfil->nombre = $request->get('name');
        $perfil->apellido = $request->get('apellido');
        $perfil->telefono = $request->get('telefono');
        $perfil->direccion = $request->get('direccion');
        $perfil->email = $request->get('email');
        $perfil->cuil_cuit = $request->get('cuil_cuit');
        $perfil->save();
        return redirect()->route('perfil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $perfil = PerfilModel::findOrFail($id);
        $$perfil->delete();
        return redirect()->route('perfil.index')->with('message', 'Perfil eliminado con exito!');
    }
}
