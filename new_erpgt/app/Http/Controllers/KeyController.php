<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyRequest;
use App\Models\Key;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KeyController extends Controller
{
    public function index($site_id)
    {   
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $site = Site::find($site_id);
        return view('pages.key.index', compact('site'));
    }

    public function listajax($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $keys = Key::getAllBySite($site_id);
        return view('pages.key.listajax', compact('keys'));
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
    public function store(KeyRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        // Add key in the table
        $key = Key::where('key_number', $request->key_number)->first();
        $delete = Key::where('key_number', $request->key_number)->whereNotNull('deleted_at')->first();

        if($key != null) {
            if($delete) {
                $key->deleted_at = null;
                $key->save();
            } else {
                $this->validate($request, array(
                    'key_number' => 'required|max:255|unique:keys'
                ));
            }
            
        } else {
            $key = new Key;
            $key->site_id = $request->site_id;
            $key->building    = $request->building;
            $key->floor    = $request->floor;
            $key->designation    = $request->designation;
            $key->cylinder_number    = $request->cylinder_number;
            $key->key_number    = $request->key_number;
            $key->comments    = $request->comments;
            $key->save();
        }

        if ($request->ajax())
        {
            if ($key){
                if (!is_dir(public_path('documents/'.$key->site_id.'/keys/'.$key->id))) {
                    mkdir(public_path('documents/'.$key->site_id.'/keys/'.$key->id));
                };
                $qrcode = new BaconQrCodeGenerator;
                $qrcode->size(80)->generate(URL::to('/key/'.$key->id), public_path('documents/'.$key->site_id.'/keys/'.$key->id.'/qr_code.svg'));
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('key.Success'));

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $key = Key::find($id);
        $site = Site::find($key->site_id);

        return view('pages.key.show', compact('key', 'site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = Key::find($id);

        return response::json($key);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeyRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $key = Key::find($id);
        $key->building    = $request->building;
        $key->floor    = $request->floor;
        $key->designation    = $request->designation;
        $key->cylinder_number    = $request->cylinder_number;
        
        if(!(strcmp($request->key_number,$key->key_number) == 0)) {
            $this->validate($request, [
                'key_number' => 'unique:keys',
            ]);
            $key->key_number    = $request->key_number;
        }

        $key->comments    = $request->comments;
        $key->save();


        
        if ($request->ajax())
        {
            if ($key){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('key.Modify'));

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }
        
        // Mettre en soft-delete
        $key = Key::find($id);
        $key->deleted_at = Carbon::now();
        $key->save();

        if ($request->ajax())
        {
            if ($key){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('key.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
