<?php

namespace App\Models;

class Forum extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forums';

    protected $fillable = array('question','description','views','user_id');

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function answers(){
        return $this->hasMany('App\Models\ForumAnswer','forum_id');
    }

}