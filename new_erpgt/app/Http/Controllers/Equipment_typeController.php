<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipment_typeRequest;
use App\Models\Domain;
use App\Models\Equipment_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Equipment_typeController extends Controller
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

        $domains = Domain::getList();
        return view('pages.equipment_types.index', compact('domains'));
    }

    public function listajax()
    {
        $domains = Domain::getList();
        $equipment_types = Equipment_type::getAll();
        return view('pages.equipment_types.listajax', compact('equipment_types', 'domains'));
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
    public function store(Equipment_typeRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/equipments/');
            $filename = remove_accents($request->Equipment_type).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        if($request->hasFile('Maintenance')) { 
            $file = $request->file('Maintenance');
            $destinationPath = public_path('documents/gammes_maintenance');
            $filemaintenance = remove_accents($request->Equipment_type).'.pdf';
            Input::file('Maintenance')->move($destinationPath, $filemaintenance);
        } else { 
            $filemaintenance = ""; 
        }


        $equipment_type = Equipment_type::where('name', $request->Equipment_type)->first();
        $delete = Equipment_type::where('name', $request->Equipment_type)->whereNotNull('deleted_at')->first();

        if($equipment_type != null) {
            if($delete) {
                $equipment_type->deleted_at = null;
                $equipment_type->domain_id = $request->Domain;
                $equipment_type->picture = $filename;
                $equipment_type->maintenance = $filemaintenance;
                $equipment_type->save();
            } else {
                $this->validate($request, array(
                    'Equipment_type' => 'required|max:255|unique:equipment_types,name'
                ));
            }
        } else {

            // Ajouter la question dans la table
            $equipment_type = new Equipment_type;
            $equipment_type->name      = $request->Equipment_type;
            $equipment_type->domain_id = $request->Domain;
            $equipment_type->picture   = $filename;
            $equipment_type->maintenance = $filemaintenance;
            $equipment_type->save();
        }

        if ($request->ajax())
        {
            if ($equipment_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type d\'équipement a été crée avec succès! ');

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
        $equipment_type = Equipment_type::find($id);

        return response::json($equipment_type);
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
            'Equipment_type' =>  'required|max:255',
            'Domain'         =>  'required',
        ));

        // Upload du fichier s'il existe 
        if($request->hasFile('Icon')) { 
            $file = $request->file('Icon');
            $destinationPath = public_path('images/equipments/');
            $filename = remove_accents($request->Equipment_type).rand(1,100).'.png';
            Input::file('Icon')->move($destinationPath, $filename);
        } else { 
            $filename = ""; 
        }

        if($request->hasFile('Maintenance')) { 
            $file = $request->file('Maintenance');
            $destinationPath = public_path('documents/gammes_maintenance');
            $filemaintenance = remove_accents($request->Equipment_type).'.pdf';
            Input::file('Maintenance')->move($destinationPath, $filemaintenance);
        } else { 
            $filemaintenance = ""; 
        }
        
        $equipment_type = Equipment_type::find($id);
        $equipment_type->name      = $request->Equipment_type;
        $equipment_type->domain_id = $request->Domain;
        if( $filename <> "" ) { $equipment_type->picture = $filename; }
        if( $filemaintenance <> "" ) { $equipment_type->maintenance = $filemaintenance; }
        $equipment_type->save();
        
        if ($request->ajax())
        {
            if ($equipment_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type d\'équipement a été modifié avec succès! ');

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
        $equipment_type = Equipment_type::find($id);
        $equipment_type->deleted_at = Carbon::now();
        $equipment_type->save();

        if ($request->ajax())
        {
            if ($equipment_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le type d\'équipement a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
