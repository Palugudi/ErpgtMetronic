<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internalcomment extends Model
{
    public static function getList()
    {
    	$internalcomments = Internalcomment::getAll();

        $result = array();
        foreach($internalcomments as $internalcomment) {
            $result[$internalcomment->id] = $internalcomment->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Internalcomment::where('deleted_at', null)->orderBy('name')->get();
    }
}