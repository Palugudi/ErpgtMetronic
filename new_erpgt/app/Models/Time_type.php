<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time_type extends Model
{
    public static function getList()
    {
    	$time_types = Time_type::getAll();

        $result = array();
        foreach($time_types as $time_type) {
            $result[$time_type->id] = $time_type->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Time_type::where('deleted_at', null)->orderBy('name')->get();
    }
}