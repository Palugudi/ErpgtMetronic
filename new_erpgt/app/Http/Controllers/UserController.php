<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\UserRequest;
use App\Models\Contact;
use App\Models\Domain;
use App\Models\Intervention;
use App\Models\Role;
use App\Models\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $roles = Role::getList();
        $intervention_domains = Domain::getList();


        return view('pages.users.index', compact('roles', 'intervention_domains'));
    }

    public function listajax()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $users = User::getAll();
        return view('pages.users.listajax', compact('users'));
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

    public function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789()_-+?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $this->validate($request, [
            'Email' => 'unique:users',
        ]);

        if(Input::has('Intern_contact')) {
            $contact = true;
        } else {
            $contact = false;
        }

        if(Input::has('Map_creator')) {
            $map_creator = true;
        } else {
            $map_creator = false;
        }


        if($contact) {
            $this->validate($request, [
                'Job' => 'required|max:255',
            ]);

            $role        = $request->Job;
            $name        = null;
            $address     = null;
            $postal_code = null;
            $city        = null;
            $domain      = null;
        } else {
            $this->validate($request, [
                'CompanyName'        => 'required|max:255',
                'CompanyAddress'     => 'required|max:255',
                'CompanyPostalCode'  => 'required|max:255|regex:`^[0-9]{5}$`',
                'CompanyCity'        => 'required|max:255',
                'InterventionDomain' => 'required|max:255',
            ]);
            
            $role        = Role::getExtern()->id;
            $name        = $request->CompanyName;
            $address     = $request->CompanyAddress;
            $postal_code = $request->CompanyPostalCode;
            $city        = $request->CompanyCity;
            $domain      = $request->InterventionDomain;
        }

        $f_co = true;
        $password = $this->random_password(8);

        $user = new User();
        $user->first_name          = ucfirst($request->First_name);
        $user->last_name           = strtoupper($request->Last_name);
        $user->email               = $request->Email;
        $user->phone               = $request->Phone;
        $user->password            = bcrypt($password);
        $user->Map_creator         = $map_creator;
        $user->intern_contact      = $contact;
        $user->company_name        = $name;
        $user->company_address     = $address;
        $user->company_postal_code = $postal_code;
        $user->company_city        = $city;
        $user->intervention_domain = $domain;
        $user->first_connection    = $f_co;
        $user->save();

        $user->roles()->attach(Role::where('id', $role)->first());

        if($user) {
            // TODO : send mail
        }

        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserSuccess'));

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
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $user = User::find($id);
        $role = Role::join('user_roles', 'roles.id', '=', 'user_roles.role_id')->where('user_id', $id)->first();
        $roles = Role::getList();
        $intervention_domains = Domain::getList();
        $sites = Site::getList();

        return view('pages.users.show', compact('user', 'role', 'roles', 'intervention_domains', 'sites'));
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

        // $user = User::find($id);
        // $role = Role::join('user_roles', 'roles.id', '=', 'user_roles.role_id')->where('user_id', $id)->first();

        $user = DB::table('users')->join('user_roles', 'users.id', '=', 'user_roles.user_id')->join('roles', 'roles.id', '=', 'user_roles.role_id')->where('user_id', $id)->select('users.id', 'first_name','last_name','email', 'phone','name', 'role_id', 'intern_contact', 'company_name', 'company_address','company_postal_code', 'company_city', 'intervention_domain', 'map_creator')->first();

        return response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $user = User::find($id);
        $user->first_name = $request->First_name;
        $user->last_name  = $request->Last_name;
        
        $user->phone      = $request->Phone;

        if(!(strcmp($request->Email,$user->email) == 0)) {
            $this->validate($request, [
                'Email' => 'unique:users',
            ]);
            $user->email      = $request->Email;
        }

        if(Input::has('Intern_contact')) {
            $contact = true;
        } else {
            $contact = false;
        }

        if(Input::has('Map_creator')) {
            $map_creator = true;
        } else {
            $map_creator = false;
        }

        $user->map_creator = $map_creator;

        if($contact) {
            $this->validate($request, [
                'Job' => 'required|max:255',
            ]);
            $role = $request->Job;
            $name = null;
            $address = null;
            $postal_code = null;
            $city = null;
            $domain = null;
        } else {
            $this->validate($request, [
                'CompanyName' => 'required|max:255',
                'CompanyAddress' => 'required|max:255',
                'CompanyPostalCode' => 'required|max:255|regex:`^[0-9]{5}$`',
                'CompanyCity' => 'required|max:255',
                'InterventionDomain' => 'required|max:255',
            ]);
            $role = Role::getExtern()->id;
            $name = $request->CompanyName;
            $address = $request->CompanyAddress;
            $postal_code = $request->CompanyPostalCode;
            $city = $request->CompanyCity;
            $domain = $request->InterventionDomain;
        }

        $user->intern_contact = $contact;
        $user->company_name = $name;
        $user->company_address = $address;
        $user->company_postal_code = $postal_code;
        $user->company_city = $city;
        $user->intervention_domain = $domain;

        $user->roles()->detach();
        $user->roles()->attach(Role::where('id', $role)->first());

        $user->save();


        
        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserModify'));

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
        // $contact = Contact::find($id);
        // $contact->deleted_at = Carbon::now();
        // $contact->save();

        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserDelete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function createUserSite(Request $request, $user_id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $site_id = $request->site_id;

        $user = User::find($user_id);
        $user->sites()->detach($site_id);
        $user->sites()->attach($site_id);

        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserDelete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function destroyUserSite(Request $request, $user_id, $site_id) {
        
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $user = User::find($user_id);
        $user->sites()->detach($site_id);

        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserDelete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function changepassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|max:255|confirmed',
            'password_confirmation' =>  'required|max:255|',
            'user_id'  => 'required|max:255',
        ]);

        $user = User::find($request->user_id);
        $user->password = bcrypt($request->password);
        $user->first_connection = false;
        $user->save();

        if ($request->ajax())
        {
            if ($user){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('general.UserDelete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
