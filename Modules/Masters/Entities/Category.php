<?php

namespace Modules\Masters\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_category',
        'description',
        'status',
        'del_status'
    ];

    protected $table = 'categories';
    
    protected static function newFactory()
    {
        return \Modules\Masters\Database\factories\CategoryFactory::new();
    }

    public static function categoryDropDown()
    {
        return Category::where('parent_category', '=', null)->with([
            'children' => function ($q) {
                $q->select('id', 'parent_category', 'name');
            }
        ])->get();
    }

    

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category', 'id')->with('children');
    }
    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category');
    }
}
