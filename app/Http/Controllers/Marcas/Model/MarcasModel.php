<?php

namespace App\Http\Controllers\Marcas\Model;

use Illuminate\Database\Eloquent\Model;

class MarcasModel extends Model
{
    protected $table = 'marcas';

    public $fillable = [
        'nombre'
    ];
}
