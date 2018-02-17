<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventiontypeRequest;
use App\Models\Interventiontype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class InterventiontypeController extends Controller
{
    public function index()
    {
        return view('pages.interventiontype.index');
    }

    public function listajax()
    {
        $interventiontypes = Interventiontype::getAll();
        return view('pages.interventiontype.listajax', compact('interventiontypes'));
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
    public function store(InterventiontypeRequest $request)
    {
        // Add interventiontype in the table

        $interventiontype = Interventiontype::where('name', $request->Interventiontype)->first();
        $delete = Interventiontype::where('name', $request->Interventiontype)->whereNotNull('deleted_at')->first();

        if($interventiontype != null) {
            if($delete) {
                $interventiontype->deleted_at = null;
                $interventiontype->save();
            } else {
                $this->validate($request, array(
                    'Interventiontype' => 'required|max:255|unique:interventiontypes,name'
                ));
            }
        } else {
            $i = interventiontype::count() + 1;
            $interventiontype = new Interventiontype;
            $interventiontype->name    = $request->Interventiontype;
            $interventiontype->order   = $i;
            $interventiontype->save();
        }

        if ($request->ajax())
        {
            if ($interventiontype){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventiontype.Success'));

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
        $interventiontype = Interventiontype::find($id);

        return response::json($interventiontype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterventiontypeRequest $request, $id)
    {
        $interventiontype = Interventiontype::find($id);
        $interventiontype->name      = $request->Interventiontype;
        $interventiontype->save();
        
        if ($request->ajax())
        {
            if ($interventiontype){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventiontype.Modify'));

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
        $interventiontype = Interventiontype::find($id);
        $interventiontype->deleted_at = Carbon::now();
        $interventiontype->save();

        if ($request->ajax())
        {
            if ($interventiontype){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventiontype.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
