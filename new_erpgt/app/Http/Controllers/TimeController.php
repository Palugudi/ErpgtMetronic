<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRequest;
use App\Models\Time;
use App\Models\Time_type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class TimeController extends Controller
{
    public function index()
    {
        return view('pages.time.index');
    }

    public function listajax($intervention_id)
    {
        $times = Time::where('intervention_id', $intervention_id)->where('deleted_at',null)->get();
        $user_names = User::getUsersName();
        $types = Time_type::getList();    

        return view('pages.time.listajax', compact('times', 'user_names', 'types'));
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
    public function store(TimeRequest $request)
    {
        // Add time in the table
        $time = new Time;
        $user = Auth::user();
        $time->user_id = $user->id;
        $time->intervention_id = $request->time_intervention;

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->date); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->date); 
        }
       
        $time->date      = $carb->format('Y-m-d');
        $time->time_used = $request->time_used;
        $time->time_type_id = $request->type;
        $time->save();

        if ($request->ajax())
        {
            if ($time){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time.Success'));

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
        $time = Time::find($id);

        return response::json($time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeRequest $request, $id)
    {
        $time = Time::find($id);
        $time->time_used = $request->time_used;
        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->date); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->date); 
        }
        $time->date      = $carb->format('Y-m-d');
        $time->time_type_id = $request->type;
        $time->save();
        
        if ($request->ajax())
        {
            if ($time){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time.Modify'));

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
        // Mettre en soft-delete
        $time = Time::find($id);
        $time->deleted_at = Carbon::now();
        $time->save();

        if ($request->ajax())
        {
            if ($time){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
