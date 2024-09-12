<?php

namespace Src\Customer\Application\UseCases;

use Src\Customer\Domain\Customer;
use Src\Customer\Domain\CustomerRepository;

class UpdateCustomer
{
    private $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id, array $data): ?Customer
    {
        $customer = $this->repository->findById($id);

        if (!$customer) {
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
