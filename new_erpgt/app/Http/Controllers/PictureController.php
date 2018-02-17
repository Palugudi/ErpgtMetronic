<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Models\Picture;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class PictureController extends Controller
{
    public function index($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $site = Site::find($id);
        return view('pages.picture.index', compact('site'));
    }

    public function listajax($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $pictures = Picture::getAll($id);
        $site = Site::find($id);
        return view('pages.picture.listajax', compact('pictures', 'site'));
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
    public function store(PictureRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$request->site_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        } else { 
            $filename = ""; 
        }

        // Add picture in the table
        $picture = new Picture;
        $picture->site_id = $request->site_id;
        $picture->picture   = $filename;
        $picture->save();

        if ($request->ajax())
        {
            if ($picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('picture.Success'));

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

        $picture = Picture::find($id);

        return response::json($picture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PictureRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(isset($request->input('Picture')[0]) && $request->input('Picture')!=''){
            $data = json_decode($request->input('Picture'));
            $destinationPath = public_path('documents/'.$request->site_id.'/pictures/');
            $filename = rand(1, 900000).'.jpg';
            $this->saveFile($data, $filename, $destinationPath);
        }

        $picture = Picture::find($id);
        if(isset($filename)) {$picture->picture = $filename;}
        $picture->save();
        
        if ($request->ajax())
        {
            if ($picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('picture.Modify'));

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
        $picture = Picture::find($id);
        $picture->deleted_at = Carbon::now();
        $picture->save();

        if ($request->ajax())
        {
            if ($picture){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('picture.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
