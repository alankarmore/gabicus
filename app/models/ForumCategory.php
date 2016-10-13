<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ForumCategory extends \Eloquent
{

    use SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'forum_categories';
    
    public function forums()
    {
        return $this->hasMany('App\Models\Forum','category_id');
    }
}