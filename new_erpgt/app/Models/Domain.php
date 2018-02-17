<?php

namespace App\Models;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public static function getList()
    {
    	$domains = Domain::getAll();

        $doms = array();
        foreach($domains as $do) {
            $doms[$do->id] = $do->name;
        }
        return $doms;
    }

    public static function getAll()
    {
    	return Domain::where('deleted_at', null)->orderBy('name')->get();
    }

    public static function getName($id)
    {
        $result = Domain::find($id);

        return $result->name;
    }
}
