<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepositoryInterface;

class GetCustomerById
{
    private CustomerRepositoryInterface $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): ?Customer
    {
        return $this->repository->findById($id);
    }
}
