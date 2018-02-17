<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    public static function getList()
    {
        $documents_types = Document_type::getAll();

        $documents = array();
        foreach($documents_types as $doc) {
            $documents[$doc->id]    = $doc->name;
        }
        return $documents;
    }

    public static function getListWithPicture()
    {
    	$documents_types = Document_type::getAll();

        $documents = array();
        foreach($documents_types as $doc) {
            $documents[$doc->id]['name']    = $doc->name;
            $documents[$doc->id]['picture'] = $doc->picture;
        }
        return $documents;
    }

    public static function getAll()
    {
    	return Document_type::where('deleted_at', null)->orderBy('name')->get();
    }
}
