<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRequest;
use App\Models\Brand;
use App\Models\Domain;
use App\Models\Equipment;
use App\Models\Localisation;
use App\Models\Map;
use App\Models\Site;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.maps.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $maps = Map::where('site_id', $id)->where('deleted_at', null)->orderBy('name')->get();
        return view('pages.maps.listajax')->withMaps($maps);
    }


    public function listequipments($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipments = Equipment::getListByID($id);
        return response::json($equipments);
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
    public function store(MapRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$request->site_id.'/maps/');
            $filename = $request->Map.'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        } else { 
            $filename = ""; 
        }

        // Ajouter le plan dans la table
        $map = new Map;
        $map->site_id = $request->site_id;
        $map->name      = $request->Map;
        $map->picture   = $filename;
        $map->save();

        if ($request->ajax())
        {
            if ($map){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le plan a été crée avec succès! ');

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $map = Map::find($id);
        $domains = Domain::getAll();
        $brands = Brand::getList();
        $localisations = Localisation::getList();
        $statuses = Status::getList();  
        $site_name = Site::getName($map->site_id);      
        return view('pages.maps.show', compact('map', 'domains', 'equipment_types', 'brands', 'localisations', 'statuses', 'site_name'));
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

        $map = Map::find($id);
        return response::json($map);
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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Validate the data
        $map = Map::find($id);
        
        $this->validate($request, array(
            'Map'      =>  'required|max:255'
        ));

        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$request->site_id.'/maps/');
            $filename = $request->Map.'_'.rand(100, 900).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        }

        // Save the data to the DB
        $map->name       = $request->Map;
        if(isset($filename)) {$map->picture    = $filename;}
        $map->save();
        
        if ($request->ajax())
        {
            if ($map){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le plan a été modifié avec succès! ');

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
        $map = Map::find($id);
        $map->deleted_at = Carbon::now();
        $map->save();

        if ($request->ajax())
        {
            if ($map){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le plan a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
