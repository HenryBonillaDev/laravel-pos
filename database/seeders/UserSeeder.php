<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new User)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        (new User)->create([
            'name' => 'cashier',
            'email' => 'cashier@cashier.com',
            'password' => bcrypt('cashier'),
        ]);

        (new User)->create([
            'name' => 'waiter',
            'email' => 'waiter@waiter.com',
            'password' => bcrypt('waiter'),
        ]);

        (new User)->create([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'password' => bcrypt('customer'),
        ]);
    }
}
