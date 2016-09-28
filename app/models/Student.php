<?php

namespace App\Models;

class Student extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    protected $fillable = array('year','location','user_id','month','college_id','education_degree_id','education_course_type_id');

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}