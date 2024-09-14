<?php

namespace Src\Order\Application\UseCases;

use Src\Order\Domain\OrderRepositoryInterface;

class DeleteOrder
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id): void
    {
        $order = $this->repository->findById($id);

        if ($order) {
            $this->repository->delete($id);
        }
    }
}
