<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      // create roles and assign existing permissions
      $role = Role::create(['name' => 'vendedor']);
      $role = Role::create(['name' => 'cliente']);
      $role = Role::create(['name' => 'proveedor']);
      $role = Role::create(['name' => 'admin']);

      // Alta de usuario admin
      $admin = User::create([
          'name' => 'Administrador',
          'email' => 'admin@admin',
          'password' => bcrypt('admin'),
      ]);
      $admin->assignRole('admin');

      // Alta de usuario admin
      $clienteFinal = User::create([
          'name' => 'Cliente Final',
          'email' => 'cfinal@cfinal',
          'password' => bcrypt('cfinal'),
      ]);
      $clienteFinal ->assignRole('cliente');

      factory(App\User::class, 3)->create(['password' => bcrypt('test')])->each(function($usuario) {
        $usuario->assignRole('cliente');
      });

      factory(App\User::class, 3)->create(['password' => bcrypt('test')])->each(function($usuario) {
        $usuario->assignRole('vendedor');
      });
    }
}
