<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear permisos
        Permission::create(['name' => 'ver perfil']);
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        Permission::create(['name' => 'ver noticia']);
        Permission::create(['name' => 'crear noticias']);
        Permission::create(['name' => 'editar noticias']);
        Permission::create(['name' => 'eliminar noticias']);

        Permission::create(['name' => 'crear genero']);

        // Crear usuario admin
        $adminUser = User::create([
            'name' => 'Pau',
            'email' => 'pau@gmail.com',
            'password' => Hash::make('1234')
        ]);

        $roleAdmin = Role::create(['name' => 'admin']);
        $adminUser->assignRole($roleAdmin);
        $permissionsAdmin=Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionsAdmin);
        

        // Crear usuario normal
        $usuario = User::create([
            'name' => 'Paulo',
            'email' => 'paulo@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        $roleUser = Role::create(['name' => 'user']);
        $usuario->assignRole($roleUser);
        $roleUser->syncPermissions(['ver perfil', 'ver noticia']);
        
        // Crear 10 usuarios adicionales
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->assignRole($roleUser);
        }
    }
}
