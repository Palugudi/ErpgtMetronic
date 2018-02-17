<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    public static function getList()
    {
    	$energys = Energy::getAll();

        $result = array();
        foreach($energys as $energy) {
            $result[$energy->id] = $energy->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Energy::where('deleted_at', null)->get();
    }
}