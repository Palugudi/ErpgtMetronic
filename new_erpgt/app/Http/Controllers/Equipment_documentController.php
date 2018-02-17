<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipment_documentRequest;
use App\Models\Document_type;
use App\Models\Equipment;
use App\Models\Equipment_document;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Equipment_documentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.equipment_document.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment_documents = Equipment_document::getAll($id);
        $site_id = Equipment_document::getSiteId($id);
        $document_types = Document_type::getList();

        return view('pages.equipment_document.listajax', compact('equipment_documents', 'site_id', 'document_types'));
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
    public function store(Equipment_documentRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment = Equipment::find($request->equipment_id);
        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$equipment->site_id.'/equipments/'.$request->equipment_id.'/documents/');
            $filename = remove_accents($request->Equipment_document).rand(1,100).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $equipment_document = Equipment_document::where('name', $request->Equipment_document)->first();
        $delete = Equipment_document::where('name', $request->Equipment_document)->whereNotNull('deleted_at')->first();

        if($equipment_document != null) {
            if($delete) {
                $equipment_document->deleted_at = null;
                $equipment_document->equipment_id = $request->equipment_id;
                $equipment_document->filename = $filename;
                $equipment_document->document_type_id = $request->Document_type;
                $equipment_document->save();
            } else {
                $this->validate($request, array(
                    'Equipment_document' => 'required|max:255|unique:equipment_documents,name'
                ));
            }
        } else {
            // Add equipment_document in the table
            $equipment_document = new Equipment_document;
            $equipment_document->name         = $request->Equipment_document;
            $equipment_document->equipment_id = $request->equipment_id;
            $equipment_document->filename     = $filename;
            $equipment_document->document_type_id = $request->Document_type;
            $equipment_document->save();
        }

        if ($request->ajax())
        {
            if ($equipment_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_document.Success'));

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

        $equipment_document = Equipment_document::find($id);

        return response::json($equipment_document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Equipment_documentRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment = Equipment::find($request->equipment_id);
        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$equipment->site_id.'/equipments/'.$request->equipment_id.'/documents/');
            $filename = remove_accents($request->Equipment_document).rand(1,100).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $equipment_document = Equipment_document::find($id);
        $equipment_document->name     = $request->Equipment_document;
        $equipment_document->filename = $filename;
        $equipment_document->save();
        
        if ($request->ajax())
        {
            if ($equipment_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_document.Modify'));

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
        $equipment_document = Equipment_document::find($id);
        $equipment_document->deleted_at = Carbon::now();
        $equipment_document->save();

        if ($request->ajax())
        {
            if ($equipment_document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_document.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
