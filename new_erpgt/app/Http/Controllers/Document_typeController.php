<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document_typeRequest;
use App\Models\Document_type;
use App\Models\Localisation;
use App\Models\Map;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Document_typeController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        return view('pages.document_types.index');
    }

    public function listajax()
    {
        $document_types = Document_type::getAll();
        return view('pages.document_types.listajax', compact('document_types'));
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
    public function store(Document_typeRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/documents/');
            $filename = remove_accents($request->Document_type).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $document_type = Document_type::where('name', $request->Document_type)->first();
        $delete = Document_type::where('name', $request->Document_type)->whereNotNull('deleted_at')->first();

        if($document_type != null) {
            if($delete) {
                $document_type->deleted_at = null;
                $document_type->picture = $filename;
                $document_type->save();
            } else {
                $this->validate($request, array(
                    'Document_type' => 'required|max:255|unique:document_types,name'
                ));
            }
        } else {
            // Ajouter la question dans la table
            $document_type = new Document_type;
            $document_type->name    = $request->Document_type;
            $document_type->picture = $filename;
            $document_type->save();
        }

        if ($request->ajax())
        {
            if ($document_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type de document a été crée avec succès! ');

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
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $document_type = Document_type::find($id);

        return response::json($document_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'Document_type' =>  'required|max:255',
        ));

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/documents/');
            $filename = remove_accents($request->Document_type).rand(1,100).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $document_type = Document_type::find($id);
        $document_type->name      = $request->Document_type;
        if( $filename <> "" ) { $document_type->picture = $filename; }
        $document_type->save();
        
        if ($request->ajax())
        {
            if ($document_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type de document a été modifié avec succès! ');

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
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Mettre en soft-delete
        $document_type = Document_type::find($id);
        $document_type->deleted_at = Carbon::now();
        $document_type->save();

        if ($request->ajax())
        {
            if ($document_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type de document a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
