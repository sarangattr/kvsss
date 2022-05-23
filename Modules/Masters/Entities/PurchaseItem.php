<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_header_id',
        'item_id',
        'quantity',
        'rate',
    ];

    protected $table = 'purchase_items';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\PurchaseItemFactory::new();
    }
}
