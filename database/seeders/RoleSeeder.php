<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Hash;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::create(['name'=>'ADMINISTRADOR']);


        // Crea un usuario
        User::create([
            'name'=> 'Test',
            'email'=> 'admin@test.com',
            'password'=> Hash::make('12345678')
        ])->assignRole('ADMINISTRADOR');

    }
}
