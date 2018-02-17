<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        return view('pages.brands.index');
    }

    public function listajax()
    {
        $brands = Brand::where('deleted_at', null)->orderBy('name')->get();
        return view('pages.brands.listajax')->withBrands($brands);
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
    public function store(BrandRequest $request)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        $brand = Brand::where('name', $request->Brand)->first();
        $delete = Brand::where('name', $request->Brand)->whereNotNull('deleted_at')->first();

        if($brand != null) {
            if($delete) {
                $brand->deleted_at = null;
                $brand->save();
            } else {
                $this->validate($request, array(
                    'Brand' => 'required|max:255|unique:brands,name'
                ));
            }
        } else {
            // Ajouter la question dans la table
            $brand = new Brand;
            $brand->name = $request->Brand;
            $brand->save();
        }

        if ($request->ajax())
        {
            if ($brand){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La marque a été crée avec succès! ');

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
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // find the question in the database and save it in a variable
        $brand = Brand::find($id);

        return response::json($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->back();
        }

        // Validate the data
        $brand = Brand::find($id);

        // Save the data to the DB
        $brand->name       = $request->Brand;
        $brand->save();
        
        if ($request->ajax())
        {
            if ($brand){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La marque a été modifié avec succès! ');

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
        $brand = Brand::find($id);
        $brand->deleted_at = Carbon::now();
        $brand->save();

        if ($request->ajax())
        {
            if ($brand){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'La marque a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
