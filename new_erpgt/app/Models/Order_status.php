<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_status extends Model
{
    public static function getList()
    {
    	$order_statuss = Order_status::getAll();

        $result = array();
        foreach($order_statuss as $order_status) {
            $result[$order_status->id] = $order_status->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Order_status::where('deleted_at', null)->orderBy('name')->get();
    }
}