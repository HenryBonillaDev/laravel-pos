<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        $cashier = User::create([
            'name' => 'cashier',
            'email' => 'cashier@cashier.com',
            'password' => bcrypt('cashier'),
        ]);
        $cashier->assignRole('cashier');

        $waiter = User::create([
            'name' => 'waiter',
            'email' => 'waiter@waiter.com',
            'password' => bcrypt('waiter'),
        ]);
        $waiter->assignRole('waiter');

        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('customer'),
        ]);
        $customer->assignRole('customer');
    }
}
