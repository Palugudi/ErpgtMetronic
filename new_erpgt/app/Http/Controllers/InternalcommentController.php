<?php

namespace App\Http\Controllers;

use App\Http\Requests\InternalcommentRequest;
use App\Models\Internalcomment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class InternalcommentController extends Controller
{
    public function index()
    {
        return view('pages.internalcomment.index');
    }

    public function listajax($intervention_id)
    {
        $internalcomments = InternalComment::where('intervention_id', $intervention_id)->where('deleted_at',null)->get();
        $user_names = User::getUsersName();
        return view('pages.internalcomment.listajax', compact('internalcomments', 'user_names'));
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
    public function store(InternalcommentRequest $request)
    {
        // Add internalcomment in the table
        $internalcomment = new Internalcomment;
        $user = Auth::user();
        $internalcomment->user_id = $user->id;
        $internalcomment->intervention_id = $request->internalcomment_intervention;
        $internalcomment->comment    = $request->i_comment;
        $internalcomment->save();

        if ($request->ajax())
        {
            if ($internalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('internalcomment.Success'));

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
        $internalcomment = Internalcomment::find($id);

        return response::json($internalcomment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternalcommentRequest $request, $id)
    {
        $id = $request->internalcomment_id;
        $internalcomment = Internalcomment::find($id);
        $internalcomment->comment      = $request->i_comment;
        $internalcomment->save();
        
        if ($request->ajax())
        {
            if ($internalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('internalcomment.Modify'));

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
        $internalcomment = Internalcomment::find($id);
        $internalcomment->deleted_at = Carbon::now();
        $internalcomment->save();

        if ($request->ajax())
        {
            if ($internalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('internalcomment.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
