<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report_pictureRequest;
use App\Models\Report;
use App\Models\Report_picture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Report_pictureController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.report_picture.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report_pictures = Report_picture::getAllByReportId($id);
        $site_id = Report_picture::getSiteId($id);
        return view('pages.report_picture.listajax', compact('report_pictures', 'site_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Report_pictureRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report = Report::find($request->report_id);
        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$report->site_id.'/reports/'.$request->report_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        } else { 
            $filename = ""; 
        }

        // Add report_picture in the table
        $report_picture = new Report_picture;
        $report_picture->report_id = $request->report_id;
        $report_picture->picture = $filename;
        $report_picture->save();

        if ($request->ajax())
        {
            if ($report_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_picture.Success'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report_picture = Report_picture::find($id);

        return response::json($report_picture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Report_pictureRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report = Report::find($request->report_id);
        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$report->site_id.'/reports/'.$request->report_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        }

        $report_picture = Report_picture::find($id);
        if(isset($filename)) {$report_picture->picture    = $filename;}
        $report_picture->save();
        
        if ($request->ajax())
        {
            if ($report_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_picture.Modify'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }
        
        // Mettre en soft-delete
        $report_picture = Report_picture::find($id);
        $report_picture->deleted_at = Carbon::now();
        $report_picture->save();

        if ($request->ajax())
        {
            if ($report_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_picture.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
