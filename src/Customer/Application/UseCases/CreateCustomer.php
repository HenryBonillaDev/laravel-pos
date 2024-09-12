<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepository;

class CreateCustomer
{
    private $repository;

    public function __construct(CustomerRepository $repository)
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
