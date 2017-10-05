<?php

use Illuminate\Database\Seeder;

use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Almacenes\Model\AlmacenesModel;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    AlmacenesModel::create([
      'nombre' => 'Default'
    ]);

    MarcasModel::create([
        'nombre' => 'Default'
    ]);

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
//    $this->call(CategoriasSeeder::class);

    $this->call(UsersSeeder::class);
    $this->call(ProveedoresSeeder::class);
    $this->call(ProductosSeeder::class);
  }
}
