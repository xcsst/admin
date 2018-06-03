<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    protected $table = 'user_category';

    protected $fillable = ['category_id'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
