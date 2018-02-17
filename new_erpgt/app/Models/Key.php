<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public static function getList()
    {
    	$keys = Key::getAll();

        $result = array();
        foreach($keys as $key) {
            $result[$key->id] = $key->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Key::where('deleted_at', null)->orderBy('site_id')->get();
    }

    public static function getAllBySite($site_id)
    {
        return Key::where('deleted_at', null)->where('site_id', $site_id)->orderBy('building')->get();
    }
}