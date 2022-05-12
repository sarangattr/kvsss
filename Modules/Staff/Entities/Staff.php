<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens,  Notifiable, HasRoles;

    protected $guard_name = 'staff';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'user_type',
        'status',
        'del_status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'staffs';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Staff\Database\factories\StaffFactory::new();
    }
}
