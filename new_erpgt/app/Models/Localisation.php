<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localisation extends Model
{
    public static function getList()
    {
    	$localisations = Localisation::getAll();

        $locals = array();
        foreach($localisations as $loc) {
            $locals[$loc->id] = $loc->name;
        }
        return $locals;
    }

    public static function getAll()
    {
    	return Localisation::where('deleted_at', null)->orderBy('name')->get();
    }
}
