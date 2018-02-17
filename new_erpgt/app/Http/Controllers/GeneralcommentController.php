<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneralcommentRequest;
use App\Models\Generalcomment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class GeneralcommentController extends Controller
{
    public function index()
    {
        return view('pages.generalcomment.index');
    }

    public function listajax($intervention_id)
    {
        $generalcomments = GeneralComment::where('intervention_id', $intervention_id)->where('deleted_at',null)->get();
        $user_names = User::getUsersName();
        return view('pages.generalcomment.listajax', compact('generalcomments', 'user_names'));
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
    public function store(GeneralcommentRequest $request)
    {
        // Add generalcomment in the table
        $generalcomment = new Generalcomment;
        $user = Auth::user();
        $generalcomment->user_id = $user->id;
        $generalcomment->intervention_id = $request->generalcomment_intervention;
        $generalcomment->comment    = $request->g_comment;
        $generalcomment->save();

        if ($request->ajax())
        {
            if ($generalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('generalcomment.Success'));

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
        $generalcomment = Generalcomment::find($id);

        return response::json($generalcomment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeneralcommentRequest $request)
    {
        $id = $request->generalcomment_id;
        $generalcomment = Generalcomment::find($id);
        $generalcomment->comment      = $request->g_comment;
        $generalcomment->save();
        
        if ($request->ajax())
        {
            if ($generalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('generalcomment.Modify'));

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
        $generalcomment = Generalcomment::find($id);
        $generalcomment->deleted_at = Carbon::now();
        $generalcomment->save();

        if ($request->ajax())
        {
            if ($generalcomment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('generalcomment.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
