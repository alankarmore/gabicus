<?php

namespace App\Models;

class UserJobs extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_jobs';

    public function job()
    {
        return $this->belongsTo('App\Models\Job','job_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}