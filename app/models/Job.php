<?php

namespace App\Models;

class Job extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    protected  $fillable = array('category_id','recruiter_id','title','description','skills','qualification','experience','created_at','location','status');

    public function recruiter()
    {
        return $this->belongsTo('App\Models\User','recruiter_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','id','category_id');
    }

    public function appliedUser()
    {
        return $this->hasMany('App\Models\UserJobs','job_id');
    }
}