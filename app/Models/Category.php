<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function parent()
    {

        return $this->belongsTo(‘Category’, ‘parent_id’);
    }

    public function allSubcategories()
    {
        return $this->subcategory()->with('allSubcategories');
    }

    public function subcategory()
    {

        return $this->hasMany('App\Models\Category', 'parent_id');

    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
