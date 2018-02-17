<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static function getList()
    {
    	$reports = Report::getAll();

        $result = array();
        foreach($reports as $report) {
            $result[$report->id] = $report->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Report::where('deleted_at', null)->orderBy('user_id')->get();
    }

    public static function getAllBySite($site_id)
    {
        return Report::where('deleted_at', null)->where('site_id', $site_id)->orderBy('user_id')->get();
    }

    public static function getAllByIntervention($intervention_id)
    {
        return Report::where('deleted_at', null)->where('intervention_id', $intervention_id)->orderBy('user_id')->get();
    }

    public static function getAllByUser($user_id)
    {
        return Report::where('deleted_at', null)->where('user_id', $user_id)->orderBy('equipment_id')->get();
    }

    public static function getAllByEquipment($equipment_id)
    {
        return Report::where('deleted_at', null)->where('equipment_id', $equipment_id)->orderBy('user_id')->get();
    }
}