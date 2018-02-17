<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public static function getList()
    {
    	$pictures = Picture::getAll();

        $result = array();
        foreach($pictures as $picture) {
            $result[$picture->id] = $picture->name;
        }
        return $result;
    }

    public static function getAll($id)
    {
    	return Picture::where('deleted_at', null)->where('site_id', $id)->get();
    }
}