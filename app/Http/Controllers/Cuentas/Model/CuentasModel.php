<?php

namespace App\Http\Controllers\Cuentas\Model;

use Illuminate\Database\Eloquent\Model;

class CuentasModel extends Model
{
    protected $table = 'cuentas';

    public $fillable = [
        'tipo',
        'nombre'
    ];
}
