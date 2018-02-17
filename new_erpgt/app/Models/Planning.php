<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Equipment;
use App\Models\Site;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    public static function getList($id)
    {
    	$plannings = Planning::getAll($id);

        $result = array();
        foreach($plannings as $planning) {
            $result[$planning->id] = $planning->name;
        }
        return $result;
    }

    public static function getAll($id)
    {
        return Planning::where('deleted_at', null)->where('site_id', $id)->get();
    }

    public static function getAllJSON($id)
    {
        $plannings = Planning::getAll($id);

        $result = array();
        foreach($plannings as $planning) {

            if($planning->equipment_id != 0) { 
                $equipment = Equipment::find($planning->equipment_id);
                $domain = Domain::find($equipment->domain_id);

                array_push($result, [
                    'id'           => "$planning->id",
                    'site_id'      => "$planning->site_id",
                    'equipment_id' => "$planning->equipment_id",
                    'title'        => "$equipment->equipment_name"." / "."$planning->name",
                    'name'         => "$planning->name",
                    'start'        => "$planning->date",
                    'url'          => '../../equipment/'.$planning->equipment_id,
                    'description'  => "$planning->description",
                    'color'        => "#"."$domain->color",
                ]);
            } else {
                $site = Site::find($planning->site_id);

                array_push($result, [
                    'id'           => "$planning->id",
                    'site_id'      => "$planning->site_id",
                    'equipment_id' => "$planning->equipment_id",
                    'title'        => "$site->name"." / "."$planning->name",
                    'name'         => "$planning->name",
                    'start'        => "$planning->date",
                    'url'          => '',
                    'description'  => "$planning->description",
                ]);
            }
        }
        return json_encode($result);
    }

    public static function getAllEquipmentJSON($equipment_id)
    {
        $plannings = Planning::where('deleted_at', null)->where('equipment_id', $equipment_id)->get();

        $result = array();
        foreach($plannings as $planning) {
            $equipment = Equipment::find($equipment_id);
            $domain = Domain::find($equipment->domain_id);

            array_push($result, [
                'id'           => "$planning->id",
                'site_id'      => "$planning->site_id",
                'equipment_id' => "$planning->equipmnent_id",
                'title'        => "$planning->name",
                'name'         => "$planning->name",
                'start'        => "$planning->date",
                'description'  => "$planning->description",
                'color'        => "#"."$domain->color",
            ]);
        }
        return json_encode($result);
    }
}