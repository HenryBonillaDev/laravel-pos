<?php

namespace Src\Customer\Infrastructure\Repositories;

use Exception;
use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepositoryInterface;
use Src\Customer\Infrastructure\Persistence\EloquentCustomer;

class CustomerRepository implements CustomerRepositoryInterface
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
        try {
            $eloquentCustomer = (new EloquentCustomer)->find($id);

            return new Customer(
                $eloquentCustomer->id,
                $eloquentCustomer->name,
                $eloquentCustomer->last_name,
                $eloquentCustomer->doc_type,
                $eloquentCustomer->dni,
                $eloquentCustomer->email
            );
        } catch (Exception $e) {
            return null;
        }

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
        return EloquentCustomer::all()->toArray();
    }

    public function findByDni(string $dni): ?Customer
    {
        try {
            $eloquentCustomer = (new EloquentCustomer)->where('dni', 'ILIKE', $dni)->first();

            return new Customer(
                $eloquentCustomer->id,
                $eloquentCustomer->name,
                $eloquentCustomer->last_name,
                $eloquentCustomer->doc_type,
                $eloquentCustomer->dni,
                $eloquentCustomer->email
            );
        } catch (Exception) {
            return null;
        }

    }
}
