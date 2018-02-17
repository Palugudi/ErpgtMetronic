<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    public static function getList()
    {
    	$priorities = Priority::getAll();

        $result = array();
        foreach($priorities as $priority) {
            $result[$priority->id] = $priority->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Priority::where('deleted_at', null)->orderBy('order')->get();
    }

    public static function getName($id)
    {
        $result = Priority::find($id);

        return $result->name;
    }
}