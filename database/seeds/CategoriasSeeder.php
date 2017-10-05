<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        CategoriasModel::create(['nombre' => 'BEBIDAS']);
        CategoriasModel::create(['nombre' => 'LACTEOS']);
        CategoriasModel::create(['nombre' => 'CARNES']);
        CategoriasModel::create(['nombre' => 'PESCADOS']);
        CategoriasModel::create(['nombre' => 'FRUTAS']);
        CategoriasModel::create(['nombre' => 'LEGUMBRES']);
        CategoriasModel::create(['nombre' => 'PAN']);
        CategoriasModel::create(['nombre' => 'PERFUMERIA']);
        CategoriasModel::create(['nombre' => 'LIMPIEZA']);
        CategoriasModel::create(['nombre' => 'HIGIENE']);
    }
}
