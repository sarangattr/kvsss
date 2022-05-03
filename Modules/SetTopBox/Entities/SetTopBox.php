<?php

namespace Modules\SetTopBox\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetTopBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'lco_id',
        'serial_no',
        'vc_no',
        'model',
        'cas',
        'stb_type',
        'supplier',
        'batch',
        'status',
        'del_status',
        'created_by',
        'assign_date',
        'activ_date',
        'deact_date',
        'react_date',
        'create_date',
    ];

    protected $table = 'set_top_boxes';
    
    protected static function newFactory()
    {
        return \Modules\SetTopBox\Database\factories\SetTopBoxFactory::new();
    }
}
