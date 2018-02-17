<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Document_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.document.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $documents = Document::getAll($id);
        $document_types = Document_type::getListWithPicture();
        return view('pages.document.listajax', compact('documents', 'document_types'));
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
    public function store(DocumentRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$request->site_id.'/documents');
            $filename = remove_accents($request->Document).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $document = Document::where('name', $request->Document)->first();
        $delete = Document::where('name', $request->Document)->whereNotNull('deleted_at')->first();

        if($document != null) {
            if($delete) {
                $document->deleted_at = null;
                $document->site_id = $request->site_id;
                $document->document_type_id = $request->Document_type;
                $document->filename = $filename;
                $document->save();
            } else {
                $this->validate($request, array(
                    'Document' => 'required|max:255|unique:documents,name'
                ));
            }
        } else {
            // Add document in the table
            $document = new Document;
            $document->name             = $request->Document;
            $document->site_id        = $request->site_id;
            $document->document_type_id = $request->Document_type;
            $document->filename         = $filename;
            $document->save();
        }

        if ($request->ajax())
        {
            if ($document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('document.Success'));

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

        $document = Document::find($id);

        return response::json($document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Upload du fichier s'il existe 
        if($request->hasFile('Doc')) { 
            $file = $request->file('Doc');
            $extension = pathinfo($_FILES["Doc"]["name"])['extension'];
            $destinationPath = public_path('documents/'.$request->site_id.'/documents');
            $filename = remove_accents($request->Doc).rand(1,100).'.'.$extension;
            Input::file('Doc')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $document = Document::find($id);
        $document->name             = $request->Document;
        $document->site_id        = $request->site_id;
        $document->document_type_id = $request->Document_type;
        $document->filename         = $filename;
        $document->save();
        
        if ($request->ajax())
        {
            if ($document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('document.Modify'));

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
        $document = Document::find($id);
        $document->deleted_at = Carbon::now();
        $document->save();

        if ($request->ajax())
        {
            if ($document){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('document.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
