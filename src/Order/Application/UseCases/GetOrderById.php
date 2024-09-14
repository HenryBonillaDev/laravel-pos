<?php

namespace Src\Order\Application\UseCases;

use Src\Order\Domain\Order;
use Src\Order\Domain\OrderRepositoryInterface;

class GetOrderById
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): ?Order
    {
        return $this->repository->findById($id);
    }
}
