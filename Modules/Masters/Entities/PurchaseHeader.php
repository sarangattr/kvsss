<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseHeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'purchase_date',
        'supplier_details',
        'total_amount',
        'discount',
        'net_amount',
        'no_of_items'
    ];

    protected $table = 'purchase_headers';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\PurchaseHeaderFactory::new();
    }
}
