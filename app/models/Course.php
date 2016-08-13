<?php

namespace App\Models;

class Course extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}