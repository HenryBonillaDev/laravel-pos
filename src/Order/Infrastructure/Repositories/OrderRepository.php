<?php

namespace Src\Order\Infrastructure\Repositories;

use Src\Order\Domain\Order;
use Src\Order\Domain\OrderRepositoryInterface;
use Src\Order\Infrastructure\Persistence\EloquentOrder;

class OrderRepository implements OrderRepositoryInterface
{

    private EloquentOrder $eloquentOrder;

    public function __construct(EloquentOrder $eloquentOrderModel)
    {
        $this->eloquentOrder = $eloquentOrderModel;
    }

    public function save(Order $order): void
    {
        $model = EloquentOrder::fromDomain($order);
        $model->save();
    }

    public function findById(string $id): ?Order
    {
        $model = $this->eloquentOrder->find($id);

        if (!$model) {
            return null;
        }

        return $model->toDomain();
    }

    public function delete(string $id): bool
    {
        return $this->eloquentOrder->destroy($id);
    }

    public function findAll(): array
    {
        return $this->eloquentOrder->all()->map(function ($model) {
            return $model->toDomain();
        })->toArray();
    }
}
