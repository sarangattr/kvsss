<?php

namespace Modules\Items\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'use',
        'number',
        'location_no',
        'model_no',
        'komment',
    ];

    protected $table = 'item_master';

    protected $casts = [
        'location_no' => 'array',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Items\Database\factories\ItemsFactory::new();
    }
}
