<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['pid', 'name', 'sort', 'status', 'img'];

    public function pidInfo()
    {
        return $this->belongsTo('App\\Models\\Category', 'pid', 'id');
    }

    public function options()
    {
        return $this->hasMany(CategoryOption::class, 'category_id', 'id');
    }
}
