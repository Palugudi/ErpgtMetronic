<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public static function getList()
    {
    	$contacts = Contact::getAll();

        $result = array();
        foreach($contacts as $contact) {
            $result[$contact->id] = $contact->name;
        }
        return $result;
    }

    public static function getAll()
    {
    	return Contact::where('deleted_at', null)->orderBy('last_name')->get();
    }
}