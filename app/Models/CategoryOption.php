<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryOption extends Model
{
    protected $table = 'category_option';
    protected $fillable = ['category_id', 'name'];

//    public function category()
//    {
//        return $this->belongsTo(Category::class, 'id', 'category_id');
//    }
}
