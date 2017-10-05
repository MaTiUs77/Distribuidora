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

    $this->call(UsersSeeder::class);

    $this->call(ProveedoresSeeder::class);
    $this->call(CategoriasSeeder::class);

    $this->call(ProductosSeeder::class);
  }
}
