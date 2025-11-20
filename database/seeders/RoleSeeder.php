<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Admin rolü
        $adminRole = Role::create(['name' => 'admin']);

        // İşletme sahibi rolü
        $ownerRole = Role::create(['name' => 'owner']);

        // Admin user oluştur
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@dijitalmenu.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Örnek işletme sahibi
        $owner = \App\Models\User::create([
            'name' => 'İşletme Sahibi',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
        ]);
        $owner->assignRole('owner');
    }
}
