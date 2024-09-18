<?php

namespace Src\Customer\Application\UseCases;

use Exception;
use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepositoryInterface;

class UpdateCustomer
{
    private CustomerRepositoryInterface $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id, array $data): ?Customer
    {
        try {
            $customer = $this->repository->findById($id);
        } catch (Exception) {
            return null;
        }

        $customer->updateDetails(
            $data['name'],
            $data['last_name'],
            $data['doc_type'],
            $data['dni'],
            $data['email']
        );

        $this->repository->save($customer);

        return $customer;
    }
}
