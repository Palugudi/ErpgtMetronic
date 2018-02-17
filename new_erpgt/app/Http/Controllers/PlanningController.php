<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanningRequest;
use App\Models\Planning;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class PlanningController extends Controller
{
    public function index($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $site = Site::find($id);
        return view('pages.planning.index', compact('site'));
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $plannings = Planning::getAllJSON($id);
        return view('pages.planning.listajax', compact('plannings'));
    }

    public function listequipmentajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $plannings = Planning::getAllEquipmentJSON($id);
        return view('pages.planning.listajax', compact('plannings'));
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
    public function store(PlanningRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->Date); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->Date); 
        }

        $date = $carb->format('Y-m-d');

        // Add planning in the table
        $planning = new Planning;
        $planning->site_id      = $request->site_id;
        $planning->equipment_id = $request->equipment_id;
        $planning->name         = $request->Name;
        $planning->date         = $date;
        $planning->description  = $request->Description;

        if(isset($request->Reminder)) {

            if(Session()->get('locale') == 'en') {
                $carbon = Carbon::createFromFormat('m/d/Y h:i A',$request->Reminder); 
            } elseif (Session()->get('locale') == 'fr') {
                $carbon = Carbon::createFromFormat('d/m/Y H:i',$request->Reminder); 
            }

            $reminder = $carbon;

            $planning->reminder = $reminder;
        }

        $planning->save();

        if ($request->ajax())
        {
            if ($planning){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('planning.Success'));

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

        $planning = Planning::find($id);

        return response::json($planning);
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

        if (!isset($request->drop)) {
            if(Session()->get('locale') == 'en') {
                $carb = Carbon::createFromFormat('m/d/Y',$request->Date); 
            } elseif (Session()->get('locale') == 'fr') {
                $carb = Carbon::createFromFormat('d/m/Y',$request->Date); 
            }

            $date = $carb->format('Y-m-d');
        } else {
            $date = $request->Date;
        }

        $planning = Planning::find($id);
        $planning->name         = $request->Name;
        $planning->date         = $date;
        $planning->description  = $request->Description;

         if(isset($request->Reminder) && $request->Reminder != '') {

            if(Session()->get('locale') == 'en') {
                $carbon = Carbon::createFromFormat('m/d/Y h:i A',$request->Reminder); 
            } elseif (Session()->get('locale') == 'fr') {
                $carbon = Carbon::createFromFormat('d/m/Y H:i',$request->Reminder); 
            }

            $reminder = $carbon;

            $planning->reminder = $reminder;
        }

        $planning->save();
        
        if ($request->ajax())
        {
            if ($planning){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('planning.Modify'));

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
        $planning = Planning::find($id);
        $planning->deleted_at = Carbon::now();
        $planning->save();

        if ($request->ajax())
        {
            if ($planning){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('planning.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
