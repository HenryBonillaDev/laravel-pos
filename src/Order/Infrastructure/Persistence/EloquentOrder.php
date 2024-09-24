<?php

namespace Src\Order\Infrastructure\Persistence;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Customer\Infrastructure\Persistence\EloquentCustomer;
use Src\Order\Domain\Order;
use Src\Product\Infrastructure\Persistence\EloquentProduct;

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

    public function customer(): BelongsTo
    {
        return $this->belongsTo(EloquentCustomer::class, 'id_customer');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function orderItems(): BelongsToMany
    {
        return $this->belongsToMany(
            EloquentProduct::class,
            'orders_products',
            'id_order',
            'id_product')
            ->withPivot('sale_price_product', 'comment');
    }
}
