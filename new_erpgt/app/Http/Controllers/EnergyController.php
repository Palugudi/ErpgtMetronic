<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnergyRequest;
use App\Models\Energy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class EnergyController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        return view('pages.energy.index');
    }

    public function listajax()
    {
        $energys = Energy::getAll();
        return view('pages.energy.listajax', compact('energys'));
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
    public function store(EnergyRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Add energy in the table
        $energy = new Energy;
        $energy->name    = $request->Energy;
        $energy->save();

        if ($request->ajax())
        {
            if ($energy){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('energy.Success'));

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

        $energy = Energy::find($id);

        return response::json($energy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnergyRequest $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $energy = Energy::find($id);
        $energy->name      = $request->Energy;
        $energy->save();
        
        if ($request->ajax())
        {
            if ($energy){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('energy.Modify'));

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
        $energy = Energy::find($id);
        $energy->deleted_at = Carbon::now();
        $energy->save();

        if ($request->ajax())
        {
            if ($energy){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('energy.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
