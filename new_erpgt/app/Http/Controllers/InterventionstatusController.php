<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionstatusRequest;
use App\Models\Interventionstatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class InterventionstatusController extends Controller
{
    public function index()
    {
        return view('pages.interventionstatus.index');
    }

    public function listajax()
    {
        $interventionstatuss = Interventionstatus::getAll();
        return view('pages.interventionstatus.listajax', compact('interventionstatuss'));
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
    public function store(InterventionstatusRequest $request)
    {
        // Add interventionstatus in the table
        $interventionstatus = Interventionstatus::where('name', $request->Interventionstatus)->first();
        $delete = Interventionstatus::where('name', $request->Interventionstatus)->whereNotNull('deleted_at')->first();

        if($interventionstatus != null) {
            if($delete) {
                $interventionstatus->deleted_at = null;
                $interventionstatus->save();
            } else {
                $this->validate($request, array(
                    'Interventionstatus' => 'required|max:255|unique:interventionstatuses,name'
                ));
            }
        } else {
            $i = Interventionstatus::count() + 1;
            $interventionstatus = new Interventionstatus;
            $interventionstatus->name    = $request->Interventionstatus;
            $interventionstatus->order   = $i;
            $interventionstatus->save();
        }

        if ($request->ajax())
        {
            if ($interventionstatus){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventionstatus.Success'));

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
        $interventionstatus = Interventionstatus::find($id);

        return response::json($interventionstatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterventionstatusRequest $request, $id)
    {
        $interventionstatus = Interventionstatus::find($id);
        $interventionstatus->name      = $request->Interventionstatus;
        $interventionstatus->save();
        
        if ($request->ajax())
        {
            if ($interventionstatus){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventionstatus.Modify'));

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
        $interventionstatus = Interventionstatus::find($id);
        $interventionstatus->deleted_at = Carbon::now();
        $interventionstatus->save();

        if ($request->ajax())
        {
            if ($interventionstatus){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('interventionstatus.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
