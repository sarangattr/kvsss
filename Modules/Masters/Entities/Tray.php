<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tray extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tray_owner',
        'status',
        'del_status'
    ];

    protected $table = 'trays';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\TrayFactory::new();
    }
}
