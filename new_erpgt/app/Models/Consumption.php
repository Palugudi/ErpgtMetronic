<?php

namespace App\Models;

use App\Models\Consumption;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    
    public static function getListWater($id)
    {
        $Water = Consumption::getAllWater($id);

        $series = array();
        foreach($Water as $bd) {
            $series[] = [
                $bd->date,
                $bd->statement,
            ];
        }

        return json_encode($series);
    }
    public static function getAllWater($id)
    {
    	return Consumption::where('deleted_at', null)->where('site_id', $id)->where('energy_id', 1)->orderBy('date')->get();
    }
    
    public static function getListGas($id)
    {
        $Gass = Consumption::getAllGas($id);

        $series = array();
        foreach($Gass as $bd) {
            $series[] = [
                $bd->date,
                $bd->statement,
            ];
        }

        return json_encode($series);
    }

    public static function getAllGas($id)
    {
    	return Consumption::where('deleted_at', null)->where('site_id', $id)->where('energy_id', 4)->orderBy('date')->get();
    }
    
    public static function getListElecHP($id)
    {
        $Elecs = Consumption::getAllElecHP($id);

        $series = array();
        foreach($Elecs as $bd) {
            $series[] = [
                $bd->date,
                $bd->statement,
            ];
        }

        return json_encode($series);
    }
    
    public static function getAllElecHP($id)
    {
        return Consumption::where('deleted_at', null)->where('site_id', $id)->where('energy_id', 2)->orderBy('date')->get();
    }
    
    public static function getListElecHC($id)
    {
        $Elecs = Consumption::getAllElecHC($id);

        $series = array();
        foreach($Elecs as $bd) {
            $series[] = [
                $bd->date,
                $bd->statement,
            ];
        }

        return json_encode($series);
    }
    
    public static function getAllElecHC($id)
    {
    	return Consumption::where('deleted_at', null)->where('site_id', $id)->where('energy_id', 3)->orderBy('date')->get();
    }
}