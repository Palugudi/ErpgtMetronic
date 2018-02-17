<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.contact.index');
    }

    public function listajax()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $contacts = User::getInternContacts();
        return view('pages.contact.listajax', compact('contacts'));
    }

    public function listajaxusers()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Add contact in the table
        $contact = new Contact;
        $contact->first_name = $request->First_name;
        $contact->last_name  = $request->Last_name;
        $contact->job        = $request->Job;
        $contact->email      = $request->Email;
        $contact->number     = $request->Number;
        $contact->save();

        if ($request->ajax())
        {
            if ($contact){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('contact.Success'));

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

        $contact = Contact::find($id);

        return response::json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $contact = Contact::find($id);
        $contact->first_name = $request->First_name;
        $contact->last_name  = $request->Last_name;
        $contact->job        = $request->Job;
        $contact->email      = $request->Email;
        $contact->number     = $request->Number;
        $contact->save();
        
        if ($request->ajax())
        {
            if ($contact){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('contact.Modify'));

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
        $contact = Contact::find($id);
        $contact->deleted_at = Carbon::now();
        $contact->save();

        if ($request->ajax())
        {
            if ($contact){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('contact.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
