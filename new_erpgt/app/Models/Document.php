<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public static function getList()
    {
    	$documents = Document::getAll();

        $result = array();
        foreach($documents as $document) {
            $result[$document->id] = $document->name;
        }
        return $result;
    }

    public static function getAll($id)
    {
    	return Document::where('deleted_at', null)->where('site_id', $id)->orderBy('name')->get();
    }
}