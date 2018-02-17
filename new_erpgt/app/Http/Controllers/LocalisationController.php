<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalisationRequest;
use App\Models\Localisation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class LocalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        return view('pages.localisations.index');
    }

    public function listajax()
    {
        $localisations = Localisation::where('deleted_at', null)->orderBy('name')->get();
        return view('pages.localisations.listajax')->withLocalisations($localisations);
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
    public function store(LocalisationRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $localisation = Localisation::where('name', $request->Localisation)->first();
        $delete = Localisation::where('name', $request->Localisation)->whereNotNull('deleted_at')->first();

        if($localisation != null) {
            if($delete) {
                $localisation->deleted_at = null;
                $localisation->save();
            } else {
                $this->validate($request, array(
                    'Localisation' => 'required|max:255|unique:localisations,name'
                ));
            }
        } else {
            // Ajouter la question dans la table
            $localisation = new Localisation;
            $localisation->name = $request->Localisation;
            $localisation->save();
        }

        if ($request->ajax())
        {
            if ($localisation){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La localisation a été crée avec succès! ');

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

        // find the question in the database and save it in a variable
        $localisation = Localisation::find($id);

        return response::json($localisation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalisationRequest $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $localisation = Localisation::find($id);

        // Save the data to the DB
        $localisation->name       = $request->Localisation;
        $localisation->save();
        
        if ($request->ajax())
        {
            if ($localisation){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La localisation a été modifié avec succès! ');

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
        $localisation = Localisation::find($id);
        $localisation->deleted_at = Carbon::now();
        $localisation->save();

        if ($request->ajax())
        {
            if ($localisation){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La localisation a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
