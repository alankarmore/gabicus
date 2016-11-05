<?php

namespace App\Models;

class City extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    public static function getCitiesByState($stateId)
    {
        $cities = self::where('states_id','=',$stateId)->get();
        if(!empty($cities) && $cities->count() > 0) {
            return $cities;
        }

        return false;
    }

}