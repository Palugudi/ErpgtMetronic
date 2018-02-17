<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_sites', 'site_id', 'user_id');
    }

    public static function getList()
    {
    	$sites = Site::getAll();

        $result = array();
        foreach($sites as $bd) {
            $result[$bd->id] = $bd->name;
        }
        return $result;
    }

    public static function getName($id)
    {
    	$site = Site::find($id);

        return $site->name;
    }

    public static function getAll()
    {
        return Site::where('deleted_at', null)->get();
    }
}
