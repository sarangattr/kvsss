<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Models extends Model
{
    use HasFactory;

    protected $fillable = ['name','model_id','brand_id'];

    protected $table = 'models';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\ModelsFactory::new();
    }
}
