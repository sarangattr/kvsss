<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'store_owner',
        'status',
        'del_status'
    ];

    protected $table = 'stores';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\StoreFactory::new();
    }
}
