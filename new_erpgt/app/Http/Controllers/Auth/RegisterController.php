<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/site';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['extern_contact'])) {
            return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'phone' => 'required',
                'password' => 'required|min:6|confirmed',
                'company_name' => 'required',
                'company_address' => 'required',
                'company_postal_code' => 'required|regex:`^[0-9]{5}$`',
                'company_city' => 'required',
                'intervention_domain' => 'required',
            ]);
        }
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        if(isset($data['intern_contact'])) {
            $contact = true;
        } else {
            $contact = false;
        }

        if($contact) {
            $role = $data['role'];
            $domain = null;
        } else {
            $role = $data['extern_contact_role'];
            $domain = $data['intervention_domain'];
        }

        $user = User::create([
            'first_name' => ucfirst($data['first_name']),
            'last_name' => strtoupper($data['last_name']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'intern_contact' => $contact,
            'company_name'   => ($data['company_name']),
            'company_address'   => ($data['company_address']),
            'company_postal_code'   => ($data['company_postal_code']),
            'company_city'   => ($data['company_city']),
            'intervention_domain'   => $domain,
        ]);

        $user->roles()->attach(Role::where('id', $role)->first());

        return $user;
    }
}
