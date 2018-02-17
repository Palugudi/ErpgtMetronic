<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interventiontype extends Model
{
    public static function getList()
    {
    	$interventiontypes = Interventiontype::getAll();

        $result = array();
        foreach($interventiontypes as $interventiontype) {
            $result[$interventiontype->id] = $interventiontype->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Interventiontype::where('deleted_at', null)->orderBy('order')->get();
    }

    public static function getName($id)
    {
        $result = Interventiontype::find($id);

        return $result->name;
    }
}