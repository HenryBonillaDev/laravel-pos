<?php

namespace Src\Order\Infrastructure\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Src\Customer\Application\UseCases\GetCustomerById;
use Src\Order\Domain\Order;
use Src\Order\Domain\OrderItem;
use Src\Order\Domain\OrderRepositoryInterface;
use Src\Order\Infrastructure\Persistence\EloquentOrder;

class OrderRepository implements OrderRepositoryInterface
{
    private EloquentOrder $eloquentOrder;
    private GetCustomerById $getCustomerById;

    public function __construct(EloquentOrder $eloquentOrderModel, GetCustomerById $getCustomerById)
    {
        $this->eloquentOrder = $eloquentOrderModel;
        $this->getCustomerById = $getCustomerById;
    }

    public function save(Order $order): void
    {
        $model = (new EloquentOrder)->updateOrCreate(
            ['id' => $order->getId()],
            [
                'id_customer' => $order->getCustomer()->id(),
                'id_user' => $order->getUser()->getId(),
                'state' => $order->getState(),
                'payment_method' => $order->getPaymentMethod(),
                'order_number' => $order->getOrderNumber(),
                'voluntary_tip_percentage' => $order->getVoluntaryTipPercentage(),
                'voluntary_tip_value' => $order->getVoluntaryTipValue(),
                'tax' => $order->getTax(),
            ]
        );

        if ($order->getItems()) {
            $itemsToSync = [];
            foreach ($order->getItems() as $item) {
                $itemsToSync[$item->getProduct()->getId()] = [
                    'sale_price_product' => $item->getSalePrice(),
                    'comment' => $item->getComment(),
                ];
            }
            if ($model instanceof EloquentOrder) {
                $model->orderItems()->sync($itemsToSync);
            }
        }

        $model->save();
    }

    public function findById(string $id): ?Order
    {
        try {
            $model = $this->eloquentOrder->with('customer', 'user', 'orderItems')->find($id);
            if (!$model) {
                return null;
            }
            return $this->orderToClass($model);
        } catch (Exception) {
            return null;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $deleted = $this->eloquentOrder->destroy($id);
            return $deleted > 0;
        } catch (Exception) {
            return false;
        }
    }

    public function findAll(): array
    {
        return $this->eloquentOrder->with('customer', 'user', 'orderItems')->get()->toArray();
    }

    /**
     * @param Model|Collection $model
     * @return Order
     */
    public function orderToClass(Model|Collection $model): Order
    {
        $customer = $this->getCustomerById->execute($model->id_customer);
        $userModel = (new User)->find($model->id_user);
        $user = new \Src\User\Domain\User($userModel->id, $userModel->name, $userModel->email);

        $order = new Order(
            $model->id,
            $customer,
            $user,
            $model->state,
            $model->payment_method,
            $model->order_number,
            $model->voluntary_tip_percentage,
            $model->voluntary_tip_value,
            $model->tax
        );

        $items = [];
        foreach ($model->orderItems as $item) {
            $items[] = new OrderItem(
                $item->id,
                $item->pivot->sale_price_product,
                $item->pivot->comment
            );
        }

        $order->setItems($items);

        return $order;
    }
}
