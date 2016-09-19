<?php

namespace App\Models;

class Employee extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

    protected $fillable = array('company_name','designation','specialization','location','user_id','total_it_experience','total_experience');
}