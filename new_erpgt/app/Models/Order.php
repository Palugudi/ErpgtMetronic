<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static function getList()
    {
    	$orders = Order::getAll();

        $result = array();
        foreach($orders as $order) {
            $result[$order->id] = $order->name;
        }
        return $result;
    }

    public static function getAll()
    {
        return Order::where('deleted_at', null)->orderBy('status_id')->get();
    }

    public static function getAllBySite($site_id)
    {
    	return Order::where('deleted_at', null)->where('site_id', $site_id)->orderBy('status_id')->get();
    }

    public static function getAllByEquipement($equipment_id)
    {
        return Order::where('deleted_at', null)->where('equipment_id', $equipment_id)->orderBy('status_id')->get();
    }

    public static function getAllByIntervention($intervention_id)
    {
        return Order::where('deleted_at', null)->where('intervention_id', $intervention_id)->orderBy('status_id')->get();
    }

    public static function getAllByUser($user_id)
    {
        return Order::where('deleted_at', null)->where('user_id', $user_id)->orderBy('status_id')->get();
    }
}