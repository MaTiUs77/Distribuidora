<?php

namespace App\Http\Controllers\Proveedores;

use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class Proveedores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = User::role('proveedor')->paginate(10);
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
        $roles = Role::where('name','proveedor')->first();
        $user = new User();
        $user->name = $request->get('nombre');
        $user->email = $request->get('email');
        $user->password = bcrypt('123');

        $user->save();

        $user->assignRole($roles);

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
        $nuevoPerfil->user_id= $user->id;
        $nuevoPerfil->save();

        return redirect()->route('proveedores.index')->with('message', 'Proveedor agregado con exito!');
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
        $user = User::findOrFail($id);
        $perfil = PerfilModel::where('user_id',$user->id)->first();
        $dato = compact('user', 'roles','perfil');
        return view('proveedores.edit', $dato);
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

        //SE MODIFICA EL EMAIL EN LAS DOS TABLAS. NORMALIZAR ESTAS TABLAS PARA NO REPETIR EL EMAIL.
        $proveedorUser = User::findOrFail($request->get('user_id'));
        $proveedorUser->email = $request->get('email');
        $proveedorUser->save();

        $proveedor = PerfilModel::find($id);
        $proveedor->nombre = $request->get('nombre');
        $proveedor->codigo = $request->get('codigo');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->tipo_identificacion = $request->get('tipo_identificacion');
        $proveedor->numero_identificacion = $request->get('numero_identificacion');
        $proveedor->email = $request->get('email');
        $proveedor->pais = $request->get('pais');
        $proveedor->provincia = $request->get('provincia');
        $proveedor->localidad = $request->get('localidad');
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('message', 'Proveedor actualizado con exito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $perfil = PerfilModel::where('user_id',$user->id)->first();
        if(isset($perfil))
        {
            $perfil->delete();
        }
        $user->delete();
        return redirect()->route('proveedores.index')->with('message', 'Proveedor eliminado con exito!');
    }
}
