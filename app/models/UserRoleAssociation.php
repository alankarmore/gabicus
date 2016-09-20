<?php

namespace App\Models;

class UserRoleAssociation extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_role_associations';

    protected $fillable = array('user_id','role_id');

    public function user(){
        return $this->belongsTo('User');
    }
}