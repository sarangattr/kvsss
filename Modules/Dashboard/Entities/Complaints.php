<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaints extends Model
{
    use HasFactory;

    protected $fillable = [
        'lco_code',
        'stb_id',
        'stb_serial',
        'stb_type',
        'stb_model',
        'complaint_id',
        'register_date',
        'currently_with',
        'currently_with_type',
        'currently_with_time',
        'complaint_raised_by',
        'complaint_reported',
        'raised_by_type',
        'lco_to_sub_time',
        'lco_to_sub_status',
        'sub_to_checkin_time',
        'sub_to_checkin_status',
        'checkin_to_tech_time',
        'checkin_to_tech_status',
        'checkin_to_tech_id',
        'checkin_to_tech_tray',
        'tech_to_sup_time',
        'tech_to_sup_status',
        'actual_complaint',
        'flashed',
        'status',
        'sup_to_checkout_time',
        'sup_to_checkout_status',
        'checkout_to_sub_time',
        'checkout_to_sub_status',
        'sub_to_lco_time',
        'sub_to_lco_status',
        'lco_time',
        'lco_status',
        'spares_used_tab_id',
        'stb_status_enb',
        'stb_del_status',
        'history_trans',
        'history_trans_status'
    ];

    protected $table = 'complaints';
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ComplaintsFactory::new();
    }
}
