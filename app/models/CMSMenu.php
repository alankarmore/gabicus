<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CMSMenu extends Model
{
    use SoftDeletingTrait;

    const MENU_ABOUT_US = 1;
    const MENU_CONTACT_US = 2;
    const MENU_SERVICES = 3;

    protected $table = 'cms_menu';

    public function includedIn()
    {
        return $this->belongsTo('\App\Models\CMSMenu', 'include_in');
    }

}