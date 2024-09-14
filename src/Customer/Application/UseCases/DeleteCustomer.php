<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\CustomerRepositoryInterface;

class DeleteCustomer
{
    private $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): bool
    {
        $customer = $this->repository->findById($id);

        if (!$customer) {
            return false;
        }
        $this->repository->delete($customer->id());

        return true;
    }
}
