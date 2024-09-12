<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\CustomerRepository;

class ListCustomers
{
    private CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
