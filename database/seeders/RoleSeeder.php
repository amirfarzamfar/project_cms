<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $user = Role::create(['name' => 'user']);
//        $user->givePermissionTo(['user.update','',]);

        $admin = Role::create(['name' => 'Admin']);
        $seller = Role::create(['name' => 'Seller']);
        $customer = Role::create(['name' => 'buyer']);
    }
}
