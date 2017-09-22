<?php

namespace App\Http\Controllers\Ventas\Model;

use Illuminate\Database\Eloquent\Model;

class VentasModel extends Model
{
    protected $table = 'ventas';

    public function vendedor()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\User','id', 'cliente_id');
    }

    public function detalles()
    {
        return $this->hasMany('App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel','venta_id', 'id');
    }

}
