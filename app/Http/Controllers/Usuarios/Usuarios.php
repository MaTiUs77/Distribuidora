<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;

class Usuarios extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $users = User::paginate(10);
        $roles = Role::all();

        $datos = compact('users','roles');
        return view('usuarios.index', $datos);
    }

    public function create()
    {
        $roles = Role::all();
        $datos = compact('roles');
        return view('usuarios.create', $datos);
    }

    public function store(Request $request)
    {
        $message =  [
          'name.required' => 'El nombre es requerido',
          'email.required'  => 'El email es requerido',
          'role_id.required'  => 'El rol es requerido',
          'email.unique'  => 'El email ya se encuentra registrado',
        ];

        $this->validate($request, [
          'name' => 'required',
          'password' => 'required',
          'email' => 'required|unique:users',
          'role_id' => 'required'
        ], $message);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $rol = Role::find($request->get('role_id'));
        $user->assignRole($rol);
        return redirect()->route('usuarios.index')->with('message', 'Usuario agregado con exito!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $dato = compact('user', 'roles');
        return view('usuarios.edit', $dato);
    }

    public function update(Request $request, $id)
    {
        $message =  [
          'name.required' => 'El nombre es requerido',
          'email.required'  => 'El email es requerido',
          'role_id.required'  => 'El rol es requerido',
          'email.unique'  => 'El email ya se encuentra registrado',
        ];

        $this->validate($request, [
          'name' => 'required',
          'password' => 'required',
          'email' => 'required|unique:users,email,'.$id,
          'role_id' => 'required'
        ], $message);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        $rol = Role::find($request->get('role_id'));
        $user->syncRoles($rol);

        return redirect()->route('usuarios.index')->with('message', 'Usuario actualizado con exito!');
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

        return $user;
        //return redirect()->route('usuarios.index')->with('message', 'Usuario eliminado con exito!');
    }
}
