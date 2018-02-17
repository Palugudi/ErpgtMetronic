<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityRequest;
use App\Models\Priority;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class PriorityController extends Controller
{
    public function index()
    {
        return view('pages.priority.index');
    }

    public function listajax()
    {
        $prioritys = Priority::getAll();
        return view('pages.priority.listajax', compact('prioritys'));
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
    public function store(PriorityRequest $request)
    {
        // Add priority in the table
        $priority = Priority::where('name', $request->Priority)->first();
        $delete = Priority::where('name', $request->Priority)->whereNotNull('deleted_at')->first();

        if($priority != null) {
            if($delete) {
                $priority->deleted_at = null;
                $priority->save();
            } else {
                $this->validate($request, array(
                    'Priority' => 'required|max:255|unique:priorities,name'
                ));
            }
        } else {
            $i = Priority::count() + 1;
            $priority = new Priority;
            $priority->name    = $request->Priority;
            $priority->order    = $i;
            $priority->save();
        }

        if ($request->ajax())
        {
            if ($priority){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('priority.Success'));

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
        $priority = Priority::find($id);

        return response::json($priority);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PriorityRequest $request, $id)
    {
        $priority = Priority::find($id);
        $priority->name      = $request->Priority;
        $priority->save();
        
        if ($request->ajax())
        {
            if ($priority){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('priority.Modify'));

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
        $priority = Priority::find($id);
        $priority->deleted_at = Carbon::now();
        $priority->save();

        if ($request->ajax())
        {
            if ($priority){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('priority.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
