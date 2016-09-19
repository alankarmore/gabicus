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

    protected $fillable = array('college_name','education','year','location','user_id');
}