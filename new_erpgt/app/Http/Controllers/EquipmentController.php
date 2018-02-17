<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Models\Brand;
use App\Models\Document_type;
use App\Models\Domain;
use App\Models\Equipment;
use App\Models\Equipment_type;
use App\Models\Intervention;
use App\Models\Localisation;
use App\Models\Map;
use App\Models\Order_status;
use App\Models\Site;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EquipmentController extends Controller
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

        return view('pages.equipments.index');
    }

    public function listajax($id_site)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $maps = Map::getListbySite($id_site);
        $localisations = Localisation::getList();
        $domains = Domain::getList();
        $equipments = Equipment::where('deleted_at', null)->where('site_id', $id_site)->orderBy('equipment_name')->get();
        return view('pages.equipments.listajax', compact('equipments', 'maps', 'localisations', 'domains'));
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
    public function store(EquipmentRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment_types = Equipment_type::getListWithPicture();
        // Ajouter la question dans la table
        $equipment = new Equipment;
        $equipment->map_id            = $request->equipment_map_id;
        $equipment->site_id         = $request->site_id;
        $equipment->domain_id         = $request->domain_id;
        $equipment->equipment_type_id = $request->Equipment_type;
        $equipment->equipment_name    = $equipment_types[$request->Equipment_type]['name'];
        $equipment->brand_id          = $request->Brand;
        $equipment->status_id         = $request->Status;
        $equipment->localisation_id   = $request->Localisation;
        $equipment->model             = $request->Model;
        $equipment->quantity          = $request->Quantity;
        $equipment->serial_number     = $request->Serial_number;
        $equipment->manufacture_date  = $request->Manufacture_date;
        $equipment->informations      = $request->Informations;
        $equipment->position_left     = $request->position_left;
        $equipment->position_top      = $request->position_top;
        $equipment->picture           = $equipment_types[$request->Equipment_type]['picture'];
        $equipment->save();

        if ($request->ajax())
        {
            if ($equipment){
                if (!is_dir(public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id))) {
                    mkdir(public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id));
                };
                QrCode::size(80)->generate(URL::to('/equipment/'.$equipment->id), public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id.'/qr_code.svg'));
                return Response::json(['success' => 'true', 'id' => $equipment->id]);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'L\'équipement a été crée avec succès! ');

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

        $user = Auth::user();
        $equipment     = Equipment::find($id);
        $equipment_type = Equipment_type::find($equipment->equipment_type_id);
        $sites         = Site::getList();
        $maps          = Map::getList();
        $statuses      = Status::getList();
        $brands        = Brand::getList();
        $localisations = Localisation::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListperSite($equipment->site_id);
        $in_equipment_show = true;
        $in_intervention_show = false;
        $document_types = Document_type::getList();

        return view('pages.equipments.show', compact('equipment', 'sites', 'maps', 'statuses', 'brands', 'localisations', 'in_equipment_show', 'o_statuses', 'interventions', 'user', 'in_intervention_show', 'equipment_type', 'document_types'));
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

        // find the equipment in the database and save it in a variable
        $equipment = Equipment::find($id);

        return response::json($equipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        $equipment = Equipment::find($id);
        $equipment_types = Equipment_type::getListWithPicture();
        // Save the data to the DB
        $equipment->map_id            = $request->equipment_map_id;
        $equipment->site_id         = $request->site_id;
        $equipment->domain_id         = $request->domain_id;
        $equipment->equipment_type_id = $request->Equipment_type;
        $equipment->equipment_name    = $equipment_types[$request->Equipment_type]['name'];
        $equipment->brand_id          = $request->Brand;
        $equipment->status_id         = $request->Status;
        $equipment->localisation_id   = $request->Localisation;
        $equipment->model             = $request->Model;
        $equipment->quantity          = $request->Quantity;
        $equipment->serial_number     = $request->Serial_number;
        $equipment->manufacture_date  = $request->Manufacture_date;
        $equipment->informations      = $request->Informations;
        $equipment->position_left     = $request->position_left;
        $equipment->position_top      = $request->position_top;
        $equipment->picture           = $equipment_types[$request->Equipment_type]['picture'];
        $equipment->save();
        
        if ($request->ajax())
        {
            if ($equipment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'L\'équipement a été modifié avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function updatePosition(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isManager() && !Auth::user()->isPlanneur() && !Auth::user()->isFM()) {
            return redirect()->back();
        }

        // Validate the data
        $equipment = Equipment::find($id);
        
        $this->validate($request, array(
            'position_left'    =>  'required|integer',
            'position_top'     =>  'required|integer'
        ));

        // Save the data to the DB
        $equipment->position_left     = $request->position_left-5;
        $equipment->position_top      = $request->position_top-5;
        $equipment->save();
        
        if ($request->ajax())
        {
            if ($equipment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'L\'équipement a été modifié avec succès! ');

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
        $equipment = Equipment::find($id);
        $equipment->deleted_at = Carbon::now();
        $equipment->save();

        if ($request->ajax())
        {
            if ($equipment){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', 'L\'équipement a été supprimé avec succès! ');

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
