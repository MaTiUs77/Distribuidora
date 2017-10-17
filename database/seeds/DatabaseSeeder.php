<?php

use Illuminate\Database\Seeder;

use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Almacenes\Model\AlmacenesModel;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(CategoriasSeeder::class);
    $this->call(ProveedoresSeeder::class);
    $this->call(UsersSeeder::class);

    $this->call(ProductosSeeder::class);
  }
}
