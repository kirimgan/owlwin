<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = [
        'area', 'neighbourhood', 'state_id'
    ];

    public function state()
    {
        return $this->hasOne('App\States', 'id', 'state_id');
    }

    public static function getForSelectBox()
    {
        $locations = self::with('state')->get();
        $locationsArray = [];
        foreach ($locations as $location){
            $row = $location->state->name;
            if($location->area) $row .= " &rarr; " . $location->area;
            if($location->neighbourhood) $row.= " &rarr; " . $location->neighbourhood;
            $locationsArray[$location->id] = $row;
        }

        asort($locationsArray);
        return $locationsArray;
    }


}
