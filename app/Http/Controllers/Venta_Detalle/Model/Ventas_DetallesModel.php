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
        return $this->belongsTo('App\Http\Controllers\Ventas\Model\VentasModel','venta_id', 'id');
    }

    public function producto()
    {
        return $this->hasOne('App\Http\Controllers\Productos\Model\ProductosModel','id', 'producto_id');
    }
}
