<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report_documentRequest;
use App\Models\Document_type;
use App\Models\Report;
use App\Models\Report_document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Report_documentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.report_document.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report_documents = Report_document::getAll($id);
        $site_id = Report_document::getSiteId($id);
        $document_types = Document_type::getList();

        return view('pages.report_document.listajax', compact('report_documents', 'site_id', 'document_types'));
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
    public function store(Report_documentRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report = Report::find($request->report_id);
        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$report->site_id.'/reports/'.$request->report_id.'/documents/');
            $filename = remove_accents($request->Report_document).rand(1,100).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $report_document = Report_document::where('name', $request->Report_document)->first();
        $delete = Report_document::where('name', $request->Report_document)->whereNotNull('deleted_at')->first();

        if($report_document != null) {
            if($delete) {
                $report_document->deleted_at = null;
                $report_document->report_id = $request->report_id;
                $report_document->filename = $filename;
                $report_document->document_type_id = $request->Document_type;
                $report_document->save();
            } else {
                $this->validate($request, array(
                    'Report_document' => 'required|max:255|unique:report_documents,name'
                ));
            }
        } else {
            // Add report_document in the table
            $report_document = new Report_document;
            $report_document->name         = $request->Report_document;
            $report_document->report_id = $request->report_id;
            $report_document->filename     = $filename;
            $report_document->document_type_id = $request->Document_type;
            $report_document->save();
        }

        if ($request->ajax())
        {
            if ($report_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_document.Success'));

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

        $report_document = Report_document::find($id);

        return response::json($report_document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Report_documentRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $report = Report::find($request->report_id);
        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$report->site_id.'/reports/'.$request->report_id.'/documents/');
            $filename = remove_accents($request->Report_document).rand(1,100).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $report_document = Report_document::find($id);
        $report_document->name     = $request->Report_document;
        $report_document->filename = $filename;
        $report_document->save();
        
        if ($request->ajax())
        {
            if ($report_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_document.Modify'));

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
        $report_document = Report_document::find($id);
        $report_document->deleted_at = Carbon::now();
        $report_document->save();

        if ($request->ajax())
        {
            if ($report_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report_document.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
