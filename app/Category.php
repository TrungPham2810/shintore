<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function categoryChildren()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

//    public function book()
//    {
//        return $this->hasMany(Book::class, 'category_id');
//    }
}
