<?php

namespace App\Http\Controllers\Api\Datatable;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\User;

class Datatable extends Controller
{
    public function marcas()
    {
        return MarcasModel::all();
    }

    public function categorias()
    {
        return CategoriasModel::all();
    }

    public function almacenes()
    {
        return AlmacenesModel::all();
    }

    public function proveedores()
    {
        return  User::role('proveedor')->get();
    }

    public function clientes()
    {
        return  User::role('cliente')->where('name','!=','Cliente Final')->get();
    }

    public function usuarios()
    {
        return  User::with('roles')->where('name','!=','Cliente Final')->get();
    }
}