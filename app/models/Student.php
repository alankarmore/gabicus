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



    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','college_state_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City','college_city_id');
    }

    public function degree()
    {
        return $this->belongsTo('App\Models\EducationDegree','education_degree_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\EducationCourseType','education_course_type_id');
    }
}