<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseRequest;
use App\Models\Domain;
use App\Models\Enterprise;
use App\Models\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class EnterpriseController extends Controller
{
    public function index($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $site = Site::find($id);
        return view('pages.enterprise.index', compact('site'));
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $enterprises = User::getExternContacts($id);
        $domains = Domain::getAll();
        return view('pages.enterprise.listajax', compact('enterprises', 'domains'));
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
    public function store(EnterpriseRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Add enterprise in the table
        $enterprise = new Enterprise;
        $enterprise->site_id          = $request->site_id;
        $enterprise->company            = $request->Company;
        $enterprise->contact_first_name = $request->Contact_first_name;
        $enterprise->contact_last_name  = $request->Contact_last_name;
        $enterprise->contact_email      = $request->Contact_email;
        $enterprise->contact_number     = $request->Contact_number;
        $enterprise->address            = $request->Address;
        $enterprise->postal_code        = $request->Postal_code;
        $enterprise->city               = $request->City;
        $enterprise->activity_domain    = $request->Activity_domain;
        $enterprise->save();

        if ($request->ajax())
        {
            if ($enterprise){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('enterprise.Success'));

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

        $enterprise = Enterprise::find($id);

        return response::json($enterprise);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnterpriseRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $enterprise = Enterprise::find($id);
        $enterprise->company            = $request->Company;
        $enterprise->contact_first_name = $request->Contact_first_name;
        $enterprise->contact_last_name  = $request->Contact_last_name;
        $enterprise->contact_email      = $request->Contact_email;
        $enterprise->contact_number     = $request->Contact_number;
        $enterprise->address            = $request->Address;
        $enterprise->postal_code        = $request->Postal_code;
        $enterprise->city               = $request->City;
        $enterprise->activity_domain    = $request->Activity_domain;
        $enterprise->save();
        
        if ($request->ajax())
        {
            if ($enterprise){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('enterprise.Modify'));

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
        $enterprise = Enterprise::find($id);
        $enterprise->deleted_at = Carbon::now();
        $enterprise->save();

        if ($request->ajax())
        {
            if ($enterprise){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('enterprise.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
