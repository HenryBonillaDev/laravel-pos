<?php

namespace Src\Order\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Src\Order\Domain\Order;

/**
 * @mixin Builder
 */
class EloquentOrder extends Model
{

    protected $table = 'orders';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'id_customer',
        'id_user',
        'state',
        'payment_method',
        'order_number',
        'voluntary_tip_percentage',
        'voluntary_tip_value',
        'tax'
    ];

    protected $casts = [
        'id' => 'string',
        'id_customer' => 'string',
        'id_user' => 'integer',
        'state' => 'string',
        'payment_method' => 'string',
        'order_number' => 'integer',
        'voluntary_tip_percentage' => 'integer',
        'voluntary_tip_value' => 'integer',
        'tax' => 'integer',
    ];

    public function toDomain(): Order
    {
        return new Order(
            $this->id,
            $this->id_customer,
            $this->id_user,
            $this->state,
            $this->payment_method,
            $this->order_number,
            $this->voluntary_tip_percentage,
            $this->voluntary_tip_value,
            $this->tax
        );
    }

    public static function fromDomain(Order $order): self
    {
        $model = new self();
        $model->id = $order->getId();
        $model->id_customer = $order->getIdCustomer();
        $model->id_user = $order->getIdUser();
        $model->state = $order->getState();
        $model->payment_method = $order->getPaymentMethod();
        $model->order_number = $order->getOrderNumber();
        $model->voluntary_tip_percentage = $order->getVoluntaryTipPercentage();
        $model->voluntary_tip_value = $order->getVoluntaryTipValue();
        $model->tax = $order->getTax();

        return $model;
    }
}
