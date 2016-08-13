<?php

namespace App\Models;

class Category extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    public function courses()
    {
        return $this->hasMany('App\Models\Course','category_id');
    }
}