<?php

namespace App\Http\Controllers;

use App\Http\Requests\Time_typeRequest;
use App\Models\Time_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Time_typeController extends Controller
{
    public function index()
    {
        return view('pages.time_type.index');
    }

    public function listajax()
    {
        $time_types = Time_type::getAll();
        return view('pages.time_type.listajax', compact('time_types'));
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
    public function store(Time_typeRequest $request)
    {
        // Add time_type in the table
        $time_type = Time_type::where('name', $request->Time_type)->first();
        $delete = Time_type::where('name', $request->Time_type)->whereNotNull('deleted_at')->first();

        if($time_type != null) {
            if($delete) {
                $time_type->deleted_at = null;
                $time_type->save();
            } else {
                $this->validate($request, array(
                    'Time_type' => 'required|max:255|unique:time_types,name'
                ));
            }
        } else {
            $time_type = new Time_type;
            $time_type->name    = $request->Time_type;
            $time_type->save();
        }

        if ($request->ajax())
        {
            if ($time_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time_type.Success'));

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
        $time_type = Time_type::find($id);

        return response::json($time_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Time_typeRequest $request, $id)
    {
        $time_type = Time_type::find($id);
        $time_type->name      = $request->Time_type;
        $time_type->save();
        
        if ($request->ajax())
        {
            if ($time_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time_type.Modify'));

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
        $time_type = Time_type::find($id);
        $time_type->deleted_at = Carbon::now();
        $time_type->save();

        if ($request->ajax())
        {
            if ($time_type){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('time_type.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
