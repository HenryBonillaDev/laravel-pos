<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepository;

class GetCustomerById
{
    private CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): ?Customer
    {
        return $this->repository->findById($id);
    }
}
