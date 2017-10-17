<?php

namespace App\Http\Controllers\Almacenes\Model;

use Illuminate\Database\Eloquent\Model;

class AlmacenesModel extends Model
{
    protected $table = 'almacenes';

    public $fillable = [
        'nombre'
    ];
}
