<?php

namespace App\Http\Controllers;

use App\Http\Requests\Equipment_pictureRequest;
use App\Models\Equipment;
use App\Models\Equipment_picture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Equipment_pictureController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.equipment_picture.index');
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment_pictures = Equipment_picture::getAllByEquipmentId($id);
        $site_id = Equipment_picture::getSiteId($id);
        return view('pages.equipment_picture.listajax', compact('equipment_pictures', 'site_id'));
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
    public function store(Equipment_pictureRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment = Equipment::find($request->equipment_id);
        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$equipment->site_id.'/equipments/'.$request->equipment_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        } else { 
            $filename = ""; 
        }

        // Add equipment_picture in the table
        $equipment_picture = new Equipment_picture;
        $equipment_picture->equipment_id = $request->equipment_id;
        $equipment_picture->picture      = $filename;
        $equipment_picture->save();

        if ($request->ajax())
        {
            if ($equipment_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_picture.Success'));

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

        $equipment_picture = Equipment_picture::find($id);

        return response::json($equipment_picture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Equipment_pictureRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment = Equipment::find($request->equipment_id);
        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$equipment->site_id.'/equipments/'.$request->equipment_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        }

        $equipment_picture = Equipment_picture::find($id);
        if(isset($filename)) {$equipment_picture->picture    = $filename;}
        $equipment_picture->save();
        
        if ($request->ajax())
        {
            if ($equipment_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_picture.Modify'));

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
        $equipment_picture = Equipment_picture::find($id);
        $equipment_picture->deleted_at = Carbon::now();
        $equipment_picture->save();

        if ($request->ajax())
        {
            if ($equipment_picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('equipment_picture.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
