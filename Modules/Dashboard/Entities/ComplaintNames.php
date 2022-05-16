<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintNames extends Model
{
    use HasFactory;

    protected $fillable = ['name','created_by'];

    protected $table = 'complaint_names';
    
    protected static function newFactory()
    {
        return \Modules\Dashboard\Database\factories\ComplaintNamesFactory::new();
    }
}
