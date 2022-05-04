<?php

namespace Modules\Items\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_no',
        'company',
        'location'
    ];

    protected $table = 'items';

    protected $casts = [
        'location' => 'array'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Items\Database\factories\ItemsFactory::new();
    }
}
