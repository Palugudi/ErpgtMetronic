<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment_document extends Model
{
    public static function getList($id)
    {
    	$equipment_documents = Equipment_document::getAll($id);

        $result = array();
        foreach($equipment_documents as $equipment_document) {
            $result[$equipment_document->id] = $equipment_document->name;
        }
        return $result;
    }

    public static function getAll($id)
    {
    	return Equipment_document::where('deleted_at', null)->where('equipment_id', $id)->orderBy('name')->get();
    }

    public static function getSiteId($id)
    {
        $equipment = Equipment::find($id);

        return $equipment->site_id;
    }
}