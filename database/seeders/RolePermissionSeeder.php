<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Daftar permissions
        $permissions = [
            'manage users',   // Untuk admin
            'manage store',   // Untuk kepala toko
            'view categories',
            'add categories',
            'edit categories',
            'delete categories',
            'view product',
            'add product',
            'edit product',
            'delete product',
            'view sales',
            'add sales',
            'edit sales',
            'delete sales',
            'process sales',  // Untuk kasir
        ];

        // Buat permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Buat roles dan tetapkan permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions); // Admin mendapatkan semua permissions

        $kepalaToko = Role::create(['name' => 'kepala toko']);
        $kepalaToko->givePermissionTo(['manage store', 'view categories','add categories','edit categories','delete categories','view product','add product','edit product','delete product','view sales','process sales']); // Kepala toko memiliki sebagian permissions

        $kasir = Role::create(['name' => 'kasir']);
        $kasir->givePermissionTo('manage store', 'process sales', 'view product','view sales','add sales','edit sales'); // Kasir hanya memiliki permission "process sales"

        // Buat user contoh
        $users = [
            [
                'name' => 'Rosidi Admin',
                'email' => 'di@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'admin',
            ],
            [
                'name' => '02 Admin',
                'email' => 'mmaarif0306@gmai.com',
                'password' => Hash::make('weng'),
                'role' => 'admin',
            ],
            [
                'name' => 'Rosidi Kepala Toko',
                'email' => 'dii@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'kepala toko',
            ],
            [
                'name' => 'Rosidi Kasir',
                'email' => 'diii@gmail.com',
                'password' => Hash::make('weng'),
                'role' => 'kasir',
            ],
        ];

        // Buat user dan tetapkan role
        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'role' => $userData['role'],
            ]);
            $user->assignRole($userData['role']); // Tetapkan role ke user
        }

        // Pesan sukses
        $this->command->info('Roles, permissions, dan users berhasil dibuat!');
    }
}
