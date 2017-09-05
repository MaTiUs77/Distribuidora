<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;

class Usuarios extends Controller
{
  public function index()
  {
    $users = User::all();

    $datos = compact('users');
    return view('usuarios.index',$datos);
  }

  public function create()
  {
    $roles = Role::all();
    $datos = compact('roles');
    return view('usuarios.create',$datos);
  }

  public function store(Request $request)
  {
    $user = new User();
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->password = bcrypt($request->get('password'));
    $user->save();

    $rol = Role::find($request->get('role_id'));
    $user->assignRole($rol);

    return redirect()->route('usuarios.index');
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $user = User::findOrFail($id);
    $roles = Role::all();

    $dato = compact('user','roles');
    return view('usuarios.edit', $dato);
  }

  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $user->name = $request->get('name');
    $user->email = $request->get('email');
    $user->password = bcrypt($request->get('password'));
    $user->save();

    $rol = Role::find($request->get('role_id'));
    $user->syncRoles($rol);

    return redirect()->route('usuarios.index');
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('usuarios.index')->with('message', 'Usuario eliminado con exito!');
  }
}
