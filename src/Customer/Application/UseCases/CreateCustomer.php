<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepositoryInterface;

class CreateCustomer
{
    private CustomerRepositoryInterface $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data): Customer
    {
        $customer = Customer::create(
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
