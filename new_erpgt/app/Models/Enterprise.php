<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    public static function getList()
    {
    	$enterprises = Enterprise::getAll();

        $result = array();
        foreach($enterprises as $enterprise) {
            $result[$enterprise->id] = $enterprise->company;
        }
        return $result;
    }

    public static function getAll($id)
    {
    	return Enterprise::where('deleted_at', null)->where('site_id', $id)->orderBy('company')->get();
    }
}