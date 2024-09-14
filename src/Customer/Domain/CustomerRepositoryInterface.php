<?php

namespace Src\Customer\Domain;

interface CustomerRepositoryInterface
{
    public function save(Customer $customer): void;

    public function findById(string $id): ?Customer;

    public function delete(string $id): bool;

    public function findByEmail(string $email): ?Customer;

    public function findAll(): array;
}
