<?php

namespace App\Http\Controllers\Productos\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductosModel extends Model
{
    protected $table = 'productos';

    public function almacen()
    {
        return $this->hasOne('App\Http\Controllers\Almacenes\Model\AlmacenesModel','id','id_almacen');
    }

    public function proveedor()
    {
        return $this->hasOne('App\Http\Controllers\Proveedores\Model\ProveedoresModel','id','id_proveedor');
    }

    public function marca()
    {
        return $this->hasOne('App\Http\Controllers\Marcas\Model\MarcasModel','id','id_marca');
    }

    public function categoria()
    {
        return $this->hasOne('App\Http\Controllers\Categorias\Model\CategoriasModel','id','id_categoria');
    }

    /**
     * Se llama de esta manera
     *
     * $conAlerta = ProductosModel::conAlertaStock()->get();
     */
    public function scopeConAlertaStock($query)
    {
        return $query->where('stock','<',DB::raw("`stock_minimo`"));
    }

    public function scopeConAlertaVencimiento($query)
    {
        // Como calculamos el vencimiento???
    }
}
