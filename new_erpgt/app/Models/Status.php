<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public static function getList()
    {
    	$statuses = Status::getAll();

        $stats = array();
        foreach($statuses as $stat) {
            $stats[$stat->id] = $stat->name;
        }
        return $stats;
    }

    public static function getAll()
    {
    	return Status::where('deleted_at', null)->orderBy('name')->get();
    }

    public static function getName($id)
    {
        $status = Status::find($id);

        return $status->name;
    }
}
