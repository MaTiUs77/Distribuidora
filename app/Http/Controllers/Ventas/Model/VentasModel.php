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

    public function vendedorPerfil()
    {
        return $this->hasOne('App\Http\Controllers\Perfil\Model\PerfilModel','id', 'user_id');
    }

    public function clientePerfil()
    {
        return $this->hasOne('App\Http\Controllers\Perfil\Model\PerfilModel','id', 'cliente_id');
    }

    public function cliente()
    {
        return $this->hasOne('App\User','id', 'cliente_id');
    }
}
