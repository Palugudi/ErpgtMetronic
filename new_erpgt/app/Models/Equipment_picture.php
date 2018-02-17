<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;

class Equipment_picture extends Model
{
    public static function getAllByEquipmentId($id)
    {
    	return Equipment_picture::where('deleted_at', null)->where('equipment_id', $id)->get();
    }

    public static function getSiteId($id)
    {
    	$equipment = Equipment::find($id);

    	return $equipment->site_id;
    }
}