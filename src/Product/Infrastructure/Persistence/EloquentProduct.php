<?php

namespace Src\Product\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * @mixin Builder
 */
class EloquentProduct extends Model
{
    protected $table = 'products';
    public $incrementing = false;
    protected $keyType = 'string'; //(UUID)
    protected $fillable = [
        'id',
        'name',
        'stock',
        'id_category',
        'price',
        'sale_price',
        'other_price',
        'state',
        'is_drink'
    ];

    public function category()
    {
        return $this->belongsTo(EloquentCategory
        ::class, 'id_category', 'id');
    }
}
