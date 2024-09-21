<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Customer\Application\UseCases\CreateCustomer;

class CustomerSeeder extends Seeder
{
    private CreateCustomer $createCustomer;

    public function __construct(CreateCustomer $createCustomer)
    {
        $this->createCustomer = $createCustomer;
    }

    public function run(): void
    {
        $this->createCustomer->execute([
            'name' => 'Consumidor',
            'last_name' => 'Final',
            'doc_type' => 'CC',
            'dni' => '222222222222',
            'email' => 'consumidor@consumidor.com',
        ]);
    }

}
