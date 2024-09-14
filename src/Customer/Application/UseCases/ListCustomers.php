<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\CustomerRepositoryInterface;

class ListCustomers
{
    private CustomerRepositoryInterface $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
