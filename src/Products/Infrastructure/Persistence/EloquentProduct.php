<?php

namespace Src\Customer\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class EloquentCustomer extends Model
{
    protected $table = 'customers';
    public $incrementing = false;
    protected $keyType = 'string'; //(UUID)
    protected $fillable = [
        'id',
        'name',
        'last_name',
        'doc_type',
        'dni',
        'email'
    ];
}
