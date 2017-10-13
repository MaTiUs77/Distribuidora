<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class Clientes extends Controller
{

    public function index()
    {
        $clientes = User::role('cliente')->paginate(10);

        $datos = compact('clientes');
        return view('clientes.index', $datos);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $roles = Role::where('name','cliente')->first();
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

        return redirect()->route('clientes.index')->with('message', 'Cliente agregado con exito!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $perfil = PerfilModel::where('user_id',$user->id)->first();
        $dato = compact('user', 'roles','perfil');
        return view('clientes.edit', $dato);
    }

    public function update(Request $request, $id)
    {
        $cliente = PerfilModel::find($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->codigo = $request->get('codigo');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->tipo_identificacion = $request->get('tipo_identificacion');
        $cliente->numero_identificacion = $request->get('numero_identificacion');
        $cliente->email = $request->get('email');
        $cliente->pais = $request->get('pais');
        $cliente->provincia = $request->get('provincia');
        $cliente->localidad = $request->get('localidad');
        $cliente->save();

        return redirect()->route('clientes.index')->with('message', 'Cliente actualizado con exito!');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $perfil = PerfilModel::where('user_id',$user->id)->first();
        if(isset($perfil))
        {
        $perfil->delete();
        }
        $user->delete();
        return redirect()->route('clientes.index')->with('message', 'Cliente eliminado con exito!');
    }
}
