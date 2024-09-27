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
        Role::firstOrCreate(['name' => 'admin']); // administrador
        Role::firstOrCreate(['name' => 'cashier']); // cajero
        Role::firstOrCreate(['name' => 'waiter']); // mesero
        Role::firstOrCreate(['name' => 'customer']); // cliente
    }
}
