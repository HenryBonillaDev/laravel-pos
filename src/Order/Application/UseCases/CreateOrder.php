<?php

namespace Src\Order\Application\UseCases;

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
            $orderData['id'] ?? null,
            $orderData['idCustomer'],
            $orderData['idUser'],
            $orderData['state'],
            $orderData['paymentMethod'],
            $orderData['orderNumber'],
            $orderData['voluntaryTipPercentage'] ?? 0,
            $orderData['voluntaryTipValue'] ?? 0,
            $orderData['tax']
        );

        $this->repository->save($order);

        return $order;
    }
}
