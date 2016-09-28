<?php

namespace App\Models;

class ForumAnswer extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_answers';

    protected $fillable = array('answers','forum_id','user_id');

    public function forum(){
        return $this->belongsTo('App\Models\Forum','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}