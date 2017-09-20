<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;
use App\Http\Controllers\Productos\Model\ProductosModel;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    // Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

    // create permissions
    Permission::create(['name' => 'productos.index']);
    Permission::create(['name' => 'productos.create']);
    Permission::create(['name' => 'productos.edit']);
    Permission::create(['name' => 'productos.destroy']);

    // create roles and assign existing permissions
    $role = Role::create(['name' => 'vendedor']);
    $role = Role::create(['name' => 'clientes']);

    $role->givePermissionTo('productos.index');
    $role->givePermissionTo('productos.create');
    $role->givePermissionTo('productos.edit');
    $role->givePermissionTo('productos.destroy');

    $role = Role::create(['name' => 'admin']);

    // Alta de usuario admin
    DB::table('users')->insert([
      'name' => 'Administrador',
      'email' => 'admin@admin',
      'password' => bcrypt('admin'),
    ]);

    $user = User::where('name','Administrador')->first();

    $user->assignRole('admin');



    AlmacenesModel::create([
      'nombre' => 'Default'
    ]);

    CategoriasModel::create([
        'nombre' => 'Default'
    ]);

    MarcasModel::create([
        'nombre' => 'Default'
    ]);

    $this->call(UsersSeeder::class);
    $this->call(ProductosSeeder::class);
    $this->call(ProveedoresSeeder::class);
  }
}
