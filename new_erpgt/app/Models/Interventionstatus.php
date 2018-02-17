<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interventionstatus extends Model
{
    public static function getList()
    {
    	$interventionstatuses = Interventionstatus::getAll();

        $result = array();
        foreach($interventionstatuses as $interventionstatus) {
            $result[$interventionstatus->id] = $interventionstatus->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Interventionstatus::where('deleted_at', null)->orderBy('order')->get();
    }

    public static function getName($id)
    {
        $result = Interventionstatus::find($id);

        return $result->name;
    }
}