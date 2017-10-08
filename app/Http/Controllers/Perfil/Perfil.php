<?php

namespace App\Http\Controllers\Perfil;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\User;
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
        $perfil = PerfilModel::where('user_id',Auth::id())->first();
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
        $nuevoPerfil->nombre = $request->get('nombre');
        $nuevoPerfil->codigo = $request->get('codigo');
        $nuevoPerfil->telefono = $request->get('telefono');
        $nuevoPerfil->direccion = $request->get('direccion');
        $nuevoPerfil->tipo_identificacion = $request->get('tipo_identificacion');
        $nuevoPerfil->numero_identificacion = $request->get('numero_identificacion');
        $nuevoPerfil->email = $request->get('email');
        $nuevoPerfil->pais = $request->get('pais');
        $nuevoPerfil->provincia = $request->get('provincia');
        $nuevoPerfil->localidad = $request->get('localidad');
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
        $perfil->nombre = $request->get('nombre');
        $perfil->codigo = $request->get('codigo');
        $perfil->telefono = $request->get('telefono');
        $perfil->direccion = $request->get('direccion');
        $perfil->tipo_identificacion = $request->get('tipo_identificacion');
        $perfil->numero_identificacion = $request->get('numero_identificacion');
        $perfil->email = $request->get('email');
        $perfil->pais = $request->get('pais');
        $perfil->provincia = $request->get('provincia');
        $perfil->localidad = $request->get('localidad');
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
        $perfil = PerfilModel::findOrFail($id);
        $$perfil->delete();
        return redirect()->route('perfil.index')->with('message', 'Perfil eliminado con exito!');
    }
}
