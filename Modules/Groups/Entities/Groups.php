<?php

namespace Modules\Groups\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'name'
    ];

    protected $table = 'groups';
    
    protected static function newFactory()
    {
        return \Modules\Groups\Database\factories\GroupsFactory::new();
    }
}
