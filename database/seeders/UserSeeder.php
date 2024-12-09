<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'spelciality' => 'general',
                'document' => 14151545,
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        /** Obtener el rol admin*/
        $role = Role::firstOrCreate(['name' => 'admin']);

        /***Asignar el rol admin al usuario creado*/
        $admin->assignRole('admin');

        $this->command->info('Admin user creado con éxito.');
    }
}
