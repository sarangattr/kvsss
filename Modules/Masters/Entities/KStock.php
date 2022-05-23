<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'owner_id',
        'quantity',
        'status'
    ];

    protected $table = 'k_stocks';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\KStockFactory::new();
    }
}
