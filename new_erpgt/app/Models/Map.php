<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public static function getListbySite($id)
    {
    	$maps = Map::where('site_id', $id)->get();

        $mapsSite = array();
        foreach($maps as $map) {
            $mapsSite[$map->id] = $map->name;
        }
        return $mapsSite;
    }

    public static function getList()
    {
    	$maps = Map::all();

        $result = array();
        foreach($maps as $map) {
            $result[$map->id] = $map->name;
        }
        return $result;
    }
}
