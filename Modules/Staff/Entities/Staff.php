<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_type',
        'status',
        'del_status'
    ];

    protected $table = 'staff';
    
    protected static function newFactory()
    {
        return \Modules\Staff\Database\factories\StaffFactory::new();
    }
}
