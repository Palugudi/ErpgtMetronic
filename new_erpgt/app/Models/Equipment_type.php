<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment_type extends Model
{
	public static function getList()
    {
    	$equipment_types = Equipment_type::getAll();

        $equips = array();
        foreach($equipment_types as $eqt) {
            $equips[$eqt->id] = $eqt->name;
        }
        return $equips;
    }

    public static function getListWithPicture()
    {
        $equipment_types = Equipment_type::getAll();

        $equips = array();
        foreach($equipment_types as $eqt) {
            $equips[$eqt->id]['name'] = $eqt->name;
            $equips[$eqt->id]['picture'] = $eqt->picture;
        }
        return $equips;
    }

    public static function getAll()
    {
    	return Equipment_type::where('deleted_at', null)->orderBy('name')->get();
    }
}
