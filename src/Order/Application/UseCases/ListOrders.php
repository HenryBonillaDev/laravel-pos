<?php

namespace Src\Order\Application\UseCases;

use Src\Order\Domain\OrderRepositoryInterface;

class ListOrders
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
