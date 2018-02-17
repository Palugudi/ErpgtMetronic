<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public static function getList()
    {
    	$brands = Brand::getAll();

        $brds = array();
        foreach($brands as $bd) {
            $brds[$bd->id] = $bd->name;
        }
        return $brds;
    }

    public static function getAll()
    {
    	return Brand::where('deleted_at', null)->orderBy('name')->get();
    }
}
