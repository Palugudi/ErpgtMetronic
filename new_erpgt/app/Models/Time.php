<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public static function getList()
    {
    	$times = Time::getAll();

        $result = array();
        foreach($times as $time) {
            $result[$time->id] = $time->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Time::where('deleted_at', null)->orderBy('name')->get();
    }
}