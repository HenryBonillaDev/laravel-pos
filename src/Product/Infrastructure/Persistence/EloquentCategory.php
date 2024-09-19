<?php

namespace Src\Product\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class EloquentCategory extends Model
{
    protected $table = 'categories';
    public $incrementing = false;
    protected $keyType = 'string'; //(UUID)
    protected $fillable = [
        'id',
        'name'
    ];
}
