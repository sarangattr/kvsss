<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brands extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'del_status'
    ];

    protected $table = 'brands';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\BrandsFactory::new();
    }
}
