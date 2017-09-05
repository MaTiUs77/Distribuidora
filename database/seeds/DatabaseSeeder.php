<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class DatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    // $this->call(UsersTableSeeder::class);

    // Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

    // create permissions
    Permission::create(['name' => 'productos.index']);
    Permission::create(['name' => 'productos.create']);
    Permission::create(['name' => 'productos.edit']);
    Permission::create(['name' => 'productos.destroy']);

    // create roles and assign existing permissions
    $role = Role::create(['name' => 'vendedor']);
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
  }
}
