<?php

namespace App\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends \Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    //protected $fillable = array('remember_token','first_name', 'last_name','email','password','gender','birth_date','state_id','city_id','phone_no','mobile_no','user_type');


    public function role(){
        return $this->hasOne('App\Models\UserRoleAssociation','user_id');
    }
    public function student(){
        return $this->hasOne('App\Models\Student','user_id');
    }
    public function employee(){
        return $this->hasOne('App\Models\Employee','user_id');
    }

    public function forum(){
        return $this->hasMany('App\Models\Forum','user_id');
    }

    public function forumAnswer(){
        return $this->hasMany('App\Models\User','user_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job','recruiter_id');
    }

    public function userJobs()
    {
        return $this->hasMany('App\Models\UserJobs','user_id');
    }

}