<?php

namespace Src\Order\Application\UseCases;

use Src\Order\Domain\Order;
use Src\Order\Domain\OrderRepositoryInterface;

class UpdateOrders
{
    private OrderRepositoryInterface $repository;

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $id, array $orderData): ?Order
    {
        $order = $this->repository->findById($id);

        if (!$order) {
            return null;
        }

        $order->setIdCustomer($orderData['idCustomer']);
        $order->setIdUser($orderData['idUser']);
        $order->setState($orderData['state']);
        $order->setPaymentMethod($orderData['paymentMethod']);
        $order->setOrderNumber($orderData['orderNumber']);
        $order->setVoluntaryTipPercentage($orderData['voluntaryTipPercentage'] ?? 0);
        $order->setVoluntaryTipValue($orderData['voluntaryTipValue'] ?? 0);
        $order->setTax($orderData['tax']);

        $this->repository->save($order);

        return $order;
    }
}
