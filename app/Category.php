<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'user_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
