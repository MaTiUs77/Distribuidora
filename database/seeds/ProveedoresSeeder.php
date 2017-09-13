<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;

class ProveedoresSeeder extends Seeder
{
    public function run()
    {
      ProveedoresModel::create([
        'nombre' => 'Proveedor Test',
        'telefono' => '2901000000',
        'direccion' => 'Ushuaia',
        'email' => 'proveedor@test.com',
      ]);
    }
}
