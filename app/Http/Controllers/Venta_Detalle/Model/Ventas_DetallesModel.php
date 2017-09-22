<?php

namespace App\Http\Controllers\Venta_Detalle\Model;

use Illuminate\Database\Eloquent\Model;

class Ventas_DetallesModel extends Model
{
    protected $table = 'venta_detalle';

    public static function rules()
    {
        return [
            'cantidad' => 'required|numeric|min:1',
            'producto_id' => 'required|numeric|min:1'
        ];
    }

    public function ventas()
    {
        return $this->hasOne('App\Http\Controllers\Ventas\Model\VentasModel','id', 'venta_id');
    }

    public function productos()
    {
        return $this->hasMany('App\Http\Controllers\Productos\Model\ProductosModel','id', 'producto_id');
    }
}
