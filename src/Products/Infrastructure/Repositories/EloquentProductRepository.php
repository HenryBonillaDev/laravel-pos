<?php

namespace Src\Customer\Infrastructure\Repositories;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepository;
use Src\Customer\Infrastructure\Persistence\EloquentCustomer;

class EloquentCustomerRepository implements CustomerRepository
{

    public function save(Customer $customer): void
    {
        $eloquentCustomer = (new EloquentCustomer)->find($customer->id()) ?? new EloquentCustomer();
        $eloquentCustomer->id = $customer->id();
        $eloquentCustomer->name = $customer->name();
        $eloquentCustomer->last_name = $customer->lastName();
        $eloquentCustomer->doc_type = $customer->docType();
        $eloquentCustomer->dni = $customer->dni();
        $eloquentCustomer->email = $customer->email();
        $eloquentCustomer->save();
    }

    public function findById(string $id): ?Customer
    {
        $eloquentCustomer = (new EloquentCustomer)->find($id);
        if (!$eloquentCustomer) {
            return null;
        }

        return new Customer(
            $eloquentCustomer->id,
            $eloquentCustomer->name,
            $eloquentCustomer->last_name,
            $eloquentCustomer->doc_type,
            $eloquentCustomer->dni,
            $eloquentCustomer->email
        );
    }

    public function delete(string $id): bool
    {
        return EloquentCustomer::destroy($id) > 0;
    }

    public function findByEmail(string $email): ?Customer
    {
        $eloquentCustomer = (new EloquentCustomer)->where('email', $email)->first();
        if (!$eloquentCustomer) {
            return null;
        }

        return new Customer(
            $eloquentCustomer->id,
            $eloquentCustomer->name,
            $eloquentCustomer->last_name,
            $eloquentCustomer->doc_type,
            $eloquentCustomer->dni,
            $eloquentCustomer->email
        );
    }

    public function findAll(): array
    {
        $eloquentCustomer = EloquentCustomer::all();
        $customers = [];
        foreach ($eloquentCustomer as $customer) {
            $customers[] = new Customer(
                $customer->id,
                $customer->name,
                $customer->last_name,
                $customer->doc_type,
                $customer->dni,
                $customer->email
            );
        }
        return $customers;
    }
}
