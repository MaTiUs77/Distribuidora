<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();

      //  $role = Role::create(['name' => 'vendedor']);
      // $permission = Permission::create(['name' => 'productos.create']);
      // $permission = Permission::create(['name' => 'productos.edit']);

//      $role = Role::findByName('vendedor');
//      $role->givePermissionTo('productos.edit');
//      $role->givePermissionTo('productos.create');

//      $user->assignRole('vendedor');

        return view('home',compact('user'));
    }
}
