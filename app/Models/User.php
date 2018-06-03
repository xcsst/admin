<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['nickname', 'username', 'password', 'type'];

    public function scopeWaiter(Builder $query)
    {
        return $query->where('type', 2);
    }

    public function scopeUser(Builder $query)
    {
        return $query->where('type', 1);
    }

    public function categorys()
    {
        return $this->hasMany(UserCategory::class, 'user_id', 'id');
    }
}
