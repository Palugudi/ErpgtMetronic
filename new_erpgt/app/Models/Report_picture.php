<?php

namespace App\Models;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;

class Report_picture extends Model
{
    public static function getAllByReportId($id)
    {
    	return Report_picture::where('deleted_at', null)->where('report_id', $id)->get();
    }

    public static function getSiteId($id)
    {
    	$report = Report::find($id);

    	return $report->site_id;
    }
}