<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
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

        return view('pages.statuses.index');
    }

    public function listajax()
    {
        $statuses = Status::where('deleted_at', null)->orderBy('name')->get();
        return view('pages.statuses.listajax')->withStatuses($statuses);
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
    public function store(StatusRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Ajouter la question dans la table

        $status = Status::where('name', $request->Status)->first();
        $delete = Status::where('name', $request->Status)->whereNotNull('deleted_at')->first();

        if($status != null) {
            if($delete) {
                $status->deleted_at = null;
                $status->save();
            } else {
                $this->validate($request, array(
                    'Status' => 'required|max:255|unique:statuses,name'
                ));
            }
        } else {
            $status = new Status;
            $status->name = $request->Status;
            $status->save();
        }

        if ($request->ajax())
        {
            if ($status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le statut a été crée avec succès! ');

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
        $status = Status::find($id);

        return response::json($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusRequest $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

       
        $status = Status::find($id);

        // Save the data to the DB
        $status->name       = $request->Status;
        $status->save();
    
        
        
        if ($request->ajax())
        {
            if ($status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le statut a été modifié avec succès! ');

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
        $status = Status::find($id);
        $status->deleted_at = Carbon::now();
        $status->save();

        if ($request->ajax())
        {
            if ($status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le statut a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
