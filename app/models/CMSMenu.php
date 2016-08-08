<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CMSMenu extends Model
{
    use SoftDeletingTrait;
    
    protected $table = 'cms_menu';

    public function includedIn()
    {
        return $this->belongsTo('\App\Models\CMSMenu', 'include_in');
    }

}