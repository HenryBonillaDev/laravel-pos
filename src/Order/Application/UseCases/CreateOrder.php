<?php

namespace Src\Order\Application\UseCases;

use Src\Order\Domain\Enums\OrderStatus;
use Src\Order\Domain\Order;
use Src\Order\Domain\OrderRepositoryInterface;

class CreateOrder
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $orderData): Order
    {
        $order = new Order(
            null,
            $orderData['idCustomer'],
            $orderData['idUser'],
            OrderStatus::Pending->label(),
            'Efectivo',
            $orderData['orderNumber'],
            0,
            0,
            0
        );

        $this->repository->save($order);

        return $order;
    }
}
