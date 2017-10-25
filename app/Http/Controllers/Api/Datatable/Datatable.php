<?php

namespace App\Http\Controllers\Api\Datatable;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\User;
use Illuminate\Support\Facades\Input;

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
}