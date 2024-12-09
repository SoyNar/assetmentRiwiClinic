<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= Role::create(['name'=> 'admin']);
        $doctor=  Role::create(['name'=> 'doctor']);
        $patient= Role::create(['name'=> 'patient']);

        /**
         * crear todos los permisos en un array
         */
        $permissions = [
            'user.create', 'user.destroy', 'user.edit', 'user.show',
            'appointment.create', 'appointment.cancel', 'appointment.update', 'appointment.show',
            'role.create', 'role.destroy', 'role.edit', 'role.show',

        ];
        /**
         * crear los permisos y buscarlos en la base de datos
         */
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * Asignando permisos a cada rol
         */
        $admin->syncPermissions($permissions);


        $doctor->syncPermissions([
            'appointment.cancel',
            'appointment.update',
            'appointment.show',
        ]);

        $patient->syncPermissions([
            'appointment.cancel',
            'appointment.update',
            'appointment.show',
        ]);


    }
}
