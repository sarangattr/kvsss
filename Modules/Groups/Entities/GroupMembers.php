<?php

namespace Modules\Groups\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'lco_code'
    ];

    protected $table = 'group_members';
    
    protected static function newFactory()
    {
        return \Modules\Groups\Database\factories\GroupMembersFactory::new();
    }
}
