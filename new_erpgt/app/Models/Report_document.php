<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report_document extends Model
{
    public static function getList($id)
    {
    	$report_documents = Report_document::getAll($id);

        $result = array();
        foreach($report_documents as $report_document) {
            $result[$report_document->id] = $report_document->name;
        }
        return $result;
    }

    public static function getAll($id)
    {
    	return Report_document::where('deleted_at', null)->where('report_id', $id)->orderBy('name')->get();
    }

    public static function getSiteId($id)
    {
        $report = Report::find($id);

        return $report->site_id;
    }
}