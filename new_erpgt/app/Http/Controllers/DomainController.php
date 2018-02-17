<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use App\Models\Domain;
use App\Models\Equipment_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class DomainController extends Controller
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

        return view('pages.domains.index');
    }

    public function listajax()
    {
        $domains = Domain::getAll();
        return view('pages.domains.listajax')->withDomains($domains);
    }

    public function equipment_typesList(Request $request, $id)
    {
        if($request->ajax()) { 
            $equipment_types = Equipment_type::where('deleted_at', null)->where('domain_id', $id)->get(); 
            return response()->json($equipment_types); 
        } 
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
    public function store(DomainRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/domains/');
            $filename = remove_accents($request->Domain).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        $domain = Domain::where('name', $request->Domain)->first();
        $delete = Domain::where('name', $request->Domain)->whereNotNull('deleted_at')->first();

        if($domain != null) {
            if($delete) {
                $domain->deleted_at = null;
                $domain->picture = $filename;
                $domain->color = $request->color;
                $domain->save();
            } else {
                $this->validate($request, array(
                    'Domain' => 'required|max:255|unique:domains,name'
                ));
            }
        } else {
            // Ajouter la question dans la table
            $domain = new Domain;
            $domain->name = $request->Domain;
            $domain->picture = $filename;
            $domain->color = $request->color;
            $domain->save();
        }

        if ($request->ajax())
        {
            if ($domain){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le domaine a été crée avec succès! ');

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
        $domain = Domain::find($id);

        return response::json($domain);
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
            'Domain'       =>  'required|max:255'
        ));

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/domains/');
            $filename = remove_accents($request->Domain).rand(1,100).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }


        $domain = Domain::find($id);
        $domain->name    = $request->Domain;
        if( $filename <> "" ) { $domain->picture = $filename; }
        $domain->color = $request->color;
        $domain->save();
        
        if ($request->ajax())
        {
            if ($domain){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le domaine a été modifié avec succès! ');

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
        $domain = Domain::find($id);
        $domain->deleted_at = Carbon::now();
        $domain->save();

        if ($request->ajax())
        {
            if ($domain){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le domaine a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
