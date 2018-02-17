<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Models\Brand;
use App\Models\Document_type;
use App\Models\Domain;
use App\Models\Equipment;
use App\Models\Equipment_type;
use App\Models\Localisation;
use App\Models\Site;
use App\Models\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        return view('pages.sites.index');
    }

    public function listajax()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $sites = Site::where('deleted_at', null)->orderBy('name')->get();
        return view('pages.sites.listajax')->withSites($sites);
    }

    public function listajaxuser($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $sites = DB::table('sites')->join('user_sites', 'sites.id', '=', 'site_id')->where('user_id', $id)->get();
        $user = User::find($id);

        return view('pages.sites.listajaxuser', compact('sites', 'user'));
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
    public function store(SiteRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->map_creator) {
            return redirect()->back();
        }

        $site = Site::where('name', $request->Site)->first();
        $delete = Site::where('name', $request->Site)->whereNotNull('deleted_at')->first();

        if($site != null) {
            if($delete) {
                $site->deleted_at = null;
                $site->address     = $request->Address;
                $site->postal_code = $request->Postal_code;
                $site->city        = $request->City;
                $site->phone       = $request->Phone;
                $site->email       = $request->Email;
                $site->save();
            } else {
                $this->validate($request, array(
                    'Site' => 'required|max:255|unique:sites,name'
                ));
            }
        } else {
            // Ajouter la question dans la table
            $site = new Site;
            $site->name        = $request->Site;
            $site->address     = $request->Address;
            $site->postal_code = $request->Postal_code;
            $site->city        = $request->City;
            $site->phone       = $request->Phone;
            $site->email       = $request->Email;
            $site->save();
        }

        if ($request->ajax())
        {
            if ($site){
                if (!is_dir(public_path('documents/'.$site->id))) {mkdir(public_path('documents/'.$site->id));};
                if (!is_dir(public_path('documents/'.$site->id.'/equipments'))) {mkdir(public_path('documents/'.$site->id.'/equipments'));};
                if (!is_dir(public_path('documents/'.$site->id.'/keys'))) {mkdir(public_path('documents/'.$site->id.'/keys'));}; 
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le site a été crée avec succès! ');

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $domains = Domain::getAll();
        $site = Site::find($id);
        $brands = Brand::getList();
        $localisations = Localisation::getList();
        $statuses = Status::getList();
        $document_types = Document_type::getList();
        return view('pages.sites.show', compact('site', 'domains', 'equipment_types', 'brands', 'localisations', 'statuses', 'document_types'));
    }

    /**
     * Display the search information.
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response

     */
    public function search(Request $request)
    {
        $Searchsites = $request->search;
        $Sites = DB::table('sites')->where('name', 'like', '%' . $Searchsites . '%')->where ( 'address', 'LIKE', '%' . $Searchsites . '%' )->orWhere ( 'postal_code', 'LIKE', '%' . $Searchsites . '%' )
    ->orWhere ( 'city', 'LIKE', '%' . $Searchsites . '%' )->orWhere ( 'phone', 'LIKE', '%' . $Searchsites . '%' )
    ->orWhere ( 'email', 'LIKE', '%' . $Searchsites . '%' )->get ();
        
        $domains = Domain::getAll();
        $brands = Brand::getList();
        $localisations = Localisation::getList();
        $statuses = Status::getList();
        $document_types = Document_type::getList();


        return view('pages.sites.show', compact('Sites', 'domains', 'equipment_types', 'brands', 'localisations', 'statuses', 'document_types'));
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

        $site = Site::find($id);
        return response::json($site);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->map_creator) {
            return redirect()->back();
        }

        // Find in the database
        $site = Site::find($id);

        // Save the data into the DB
        $site->name        = $request->Site;
        $site->address     = $request->Address;
        $site->postal_code = $request->Postal_code;
        $site->city        = $request->City;
        $site->phone       = $request->Phone;
        $site->email       = $request->Email;
        $site->save();
        
        if ($request->ajax())
        {
            if ($site){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le site a été modifié avec succès! ');

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->map_creator) {
            return redirect()->back();
        }

        // Mettre en soft-delete
        $site = Site::find($id);
        $site->deleted_at = Carbon::now();
        $site->save();

        if ($request->ajax())
        {
            if ($site){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'Le site a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function downloadFile($id, $name)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $myFile = public_path('documents/'.$id.'/documents/'.$name);
        $path_parts = pathinfo($myFile);

        if($path_parts['extension'] == "pdf") {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename='.$myFile);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($myFile);
        }

        return response()->download($myFile);
    }

    public function downloadEquipmentFile($id, $equipment_id, $name)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $myFile = public_path('documents/'.$id.'/equipments/'.$equipment_id.'/documents/'.$name);

        return response()->download($myFile);
    }
}
