<?php

namespace App\Models;

class Enroll extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enrollments';
    
    public function courseInfo()
    {
        return $this->belongsTo('App\Models\Course','course','id');
    }
}