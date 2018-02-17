<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsumptionRequest;
use App\Models\Consumption;
use App\Models\Energy;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ConsumptionController extends Controller
{
    public function index($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $site = Site::find($id);
        $energies = Energy::getList();
        return view('pages.consumption.index', compact('energies', 'site'));
    }

    public function waterlistajax($id)
    {
        $waters = Consumption::getAllWater($id);
        return view('pages.consumption.waterlistajax', compact('waters'));
    }

    public function gaslistajax($id)
    {
        $gazs = Consumption::getAllGas($id);
        return view('pages.consumption.gaslistajax', compact('gazs'));
    }

    public function elechplistajax($id)
    {
        $elecshp = Consumption::getAllElecHp($id);
        return view('pages.consumption.elechplistajax', compact('elecshp'));
    }

    public function elechclistajax($id)
    {
        $elecshc = Consumption::getAllElecHc($id);
        return view('pages.consumption.elechclistajax', compact('elecshc'));
    }

    public function watergraphajax($id)
    {
        $waters = Consumption::getListWater($id);
        return view('pages.consumption.watergraphajax', compact('waters'));
    }

    public function gasgraphajax($id)
    {
        $gazs = Consumption::getListGas($id);
        return view('pages.consumption.gasgraphajax', compact('gazs'));
    }

    public function elechpgraphajax($id)
    {
        $elecshp = Consumption::getListElecHP($id);
        return view('pages.consumption.elechpgraphajax', compact('elecshp'));
    }

    public function elechcgraphajax($id)
    {
        $elecshc = Consumption::getListElecHC($id);
        return view('pages.consumption.elechcgraphajax', compact('elecshc'));
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
    public function store(ConsumptionRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->Consumption_date); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->Consumption_date); 
        }

        $date = $carb->format('Y-m-d');

        $cons = Consumption::where('deleted_at', null)
                            ->where('site_id', $request->site_id)
                            ->where('energy_id', $request->Energy)
                            ->where('date', '<', $date)
                            ->orderBy('date', 'DESC')->first();

        if (isset($cons)) {
            $conso = $request->Consumption - $cons->statement;
        } else {
            $conso = $request->Consumption;
        }

        // Add consumption in the table
        $consumption = new Consumption;
        $consumption->site_id    = $request->site_id;
        $consumption->energy_id    = $request->Energy;
        $consumption->date         = $date;
        $consumption->statement    = $request->Consumption;
        $consumption->consumptions = $conso;
        $consumption->comment      = $request->Comment;
        $consumption->save();

        if ($request->ajax())
        {
            if ($consumption){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('consumption.Success'));

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

        $consumption = Consumption::find($id);

        return response::json($consumption);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumptionRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->Consumption_date); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->Consumption_date); 
        }

        $date = $carb->format('Y-m-d');


        $cons = Consumption::where('deleted_at', null)
                            ->where('site_id', $request->site_id)
                            ->where('energy_id', $request->Energy)
                            ->where('date', '<', $date)
                            ->where('id', '<>', $id)
                            ->orderBy('date', 'DESC')->first();

        if (isset($cons)) {
            $conso = $request->Consumption - $cons->statement;
        } else {
            $conso = $request->Consumption;
        }

        $consumption = Consumption::find($id);
        $consumption->energy_id = $request->Energy;
        $consumption->date      = $date;
        $consumption->statement = $request->Consumption;
        $consumption->consumptions = $conso;
        $consumption->comment   = $request->Comment;
        $consumption->save();
        
        if ($request->ajax())
        {
            if ($consumption){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('consumption.Modify'));

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
        $consumption = Consumption::find($id);
        $consumption->deleted_at = Carbon::now();
        $consumption->save();

        if ($request->ajax())
        {
            if ($consumption){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('consumption.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
