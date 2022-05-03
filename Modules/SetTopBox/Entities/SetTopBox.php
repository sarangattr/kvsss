<?php

namespace Modules\SetTopBox\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetTopBox extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\SetTopBox\Database\factories\SetTopBoxFactory::new();
    }
}
