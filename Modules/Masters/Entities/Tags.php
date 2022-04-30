<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'description',
        'status',
        'del_status'
    ];

    protected $table = 'tags';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\TagsFactory::new();
    }
}
