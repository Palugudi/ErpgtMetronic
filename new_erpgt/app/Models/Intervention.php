<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    public static function getList()
    {
    	$interventions = Intervention::getAll();

        $result = array();
        foreach($interventions as $intervention) {
            $result[$intervention->id] = $intervention->name;
        }
        return $result;
    }

    public static function getListWithNoLinked() {
        $interventions = Intervention::getAll();

        $result = array();
        if(Session()->get('locale') == 'en') {
            $result[0] = "Not linked to an intervention";
        } else {
            $result[0] = "Non lié à une intervention";
        }
        foreach($interventions as $intervention) {
            $result[$intervention->id] = $intervention->name;
        }
        return $result;
    }

    public static function getAll()
    {
        return Intervention::where('deleted_at', null)->get();
    }

    public static function getAllperSite($id)
    {
    	return Intervention::where('deleted_at', null)->where('site_id', $id)->get();
    }

    public static function getListperSite($id)
    {
        $interventions = Intervention::getAllperSite($id);

        $result = array();
        if(Session()->get('locale') == 'en') {
            $result[0] = "Not linked to an intervention";
        } else {
            $result[0] = "Non lié à une intervention";
        }
        foreach($interventions as $intervention) {
            $result[$intervention->id] = $intervention->reference_WO;
        }
        return $result;
    }

    public static function getAllperUser($id)
    {
        return Intervention::where('assigned_id', $id)->where('deleted_at', null)->get();
    }
}