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
        Role::create(['name' => 'admin']); // administrador
        Role::create(['name' => 'cashier']); // cajero
        Role::create(['name' => 'waiter']); // mesero
        Role::create(['name' => 'customer']); // cliente
    }
}
