<?php

namespace App\Models;

use App\Models\Localisation;
use App\Models\Map;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	public static function getListByID($map_id)
    {
    	return Equipment::where('map_id', $map_id)->where('deleted_at', null)->get();
    }

    public static function getList()
    {
    	$equipments = Equipment::getAll();

        $equips = array();
        if(Session()->get('locale') == 'en') {
            $equips[0] = "Not linked to an equipment";
        } else {
            $equips[0] = "Non lié à un équipement";
        }
        foreach($equipments as $equ) {
            $equips[$equ->id] = $equ->equipment_name;
        }

        return $equips;
    }

    public static function getLocalisations() 
    {
        $equipments = Equipment::getAll();

        $equips = array();
        foreach($equipments as $equ) {
            $equips[$equ->id] = $equ->localisation_id;
        }

        return $equips;
    }

    public static function getTypes()
    {
        $equipments = Equipment::getAll();

        $equips = array();
        foreach($equipments as $equ) {
            $equips[$equ->id] = $equ->equipment_type_id;
        }

        return $equips;
    }

    public static function getAll()
    {
    	return Equipment::where('deleted_at', null)->orderBy('equipment_name')->get();
    }

    public static function getAllBySite($site_id)
    {
        return Equipment::where('site_id', $site_id)->where('deleted_at', null)->get();
    }

    public static function getListBySite($site_id)
    {
        $equipments = Equipment::getAllBySite($site_id);

        $equips = array();
        foreach($equipments as $equ) {
            $map = Map::find($equ->map_id);
            $loc = Localisation::find($equ->localisation_id);
            $equips[$equ->id] = $equ->equipment_name.", ".$loc->name.(Session()->get('locale') == 'en' ? " (Map : " :" (Plan : ").$map->name.")";
        }

        return $equips;
    }

    public static function getListWithNoLinked($site_id)
    {
        $equipments = Equipment::getAllBySite($site_id);

        $equips = array();
        if(Session()->get('locale') == 'en') {
            $equips[0] = "Not linked to an equipment";
        } else {
            $equips[0] = "Non lié à un équipement";
        }
        foreach($equipments as $equ) {
            $equips[$equ->id] = $equ->equipment_name;
        }

        return $equips;
    }
}
