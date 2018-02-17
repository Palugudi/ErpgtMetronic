<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generalcomment extends Model
{
    public static function getList()
    {
    	$generalcomments = Generalcomment::getAll();

        $result = array();
        foreach($generalcomments as $generalcomment) {
            $result[$generalcomment->id] = $generalcomment->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Generalcomment::where('deleted_at', null)->orderBy('name')->get();
    }
}