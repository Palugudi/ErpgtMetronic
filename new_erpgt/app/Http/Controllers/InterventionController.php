<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Brand;
use App\Models\Domain;
use App\Models\Equipment;
use App\Models\Equipment_type;
use App\Models\Intervention;
use App\Models\Interventionstatus;
use App\Models\Interventiontype;
use App\Models\Localisation;
use App\Models\Order_status;
use App\Models\Priority;
use App\Models\Site;
use App\Models\Time_type;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class InterventionController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $sites = Site::getList();
        $assigned = User::getAssigned();
        $domains = Domain::getList();
        $interventionstatuses = Interventionstatus::getList();
        $interventiontypes = Interventiontype::getList();
        $priorities = Priority::getList();
        return view('pages.intervention.index', compact('sites', 'assigned', 'domains', 'interventionstatuses', 'interventiontypes', 'priorities'));
    }

    public function listajax()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        if((!Auth::user()->isTech() && !Auth::user()->isExternContact())) {
            $interventions = Intervention::getAll();
        } elseif(Auth::user()->isTech() || Auth::user()->isExternContact()) {
            $interventions = Intervention::getAllperUser(Auth::user()->id);
        }
        $sites = Site::getList();
        $assigned = User::getAssigned();
        $domains = Domain::getList();
        $interventionstatuses = Interventionstatus::getList();
        $interventiontypes = Interventiontype::getList();
        $priorities = Priority::getList();
        return view('pages.intervention.listajax', compact('sites', 'assigned', 'domains', 'interventionstatuses', 'interventiontypes', 'priorities', 'interventions'));
    }

    public function listajaxsite($id)
    {
        // if (!Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
        //     return redirect()->back();
        // }

        $interventions = Intervention::getAllperSite($id);
        $assigned = User::getAssigned();
        $domains = Domain::getList();
        $interventionstatuses = Interventionstatus::getList();
        $interventiontypes = Interventiontype::getList();
        $priorities = Priority::getList();
        return view('pages.intervention.listajaxsite', compact('assigned', 'domains', 'interventionstatuses', 'interventiontypes', 'priorities', 'interventions'));
    }

    public function listajaxuser($id)
    {
        // if (!Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
        //     return redirect()->back();
        // }

        $interventions = Intervention::getAllperUser($id);
        $assigned = User::getAssigned();
        $domains = Domain::getList();
        $interventionstatuses = Interventionstatus::getList();
        $interventiontypes = Interventiontype::getList();
        $priorities = Priority::getList();
        return view('pages.intervention.listajaxuser', compact('assigned', 'domains', 'interventionstatuses', 'interventiontypes', 'priorities', 'interventions'));
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
    public function store(InterventionRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        // Add intervention in the table
        $intervention = new Intervention;
        $intervention->site_id       = $request->Site;
        $intervention->assigned_id = $request->Assigned;
        $intervention->domain_id     = $request->Domain;
        $intervention->reference_WO  = $request->ReferenceWO;
        $intervention->status_id     = $request->Interventionstatus;
        $intervention->type          = $request->Interventiontype;
        $intervention->request       = $request->Request;
        $intervention->priority_id   = $request->Priority;
        $intervention->planneur_id   = Auth::user()->id;
        $intervention->save();

        if ($request->ajax())
        {
            if ($intervention){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('intervention.Success'));

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $intervention    = Intervention::find($id);
        $assigned = User::getAssigned();
        $assigned_name = User::getName($intervention->assigned_id);
        $planneur_name   = User::getName($intervention->planneur_id);
        $site_name       = Site::getName($intervention->site_id);
        $status_name     = Interventionstatus::getName($intervention->status_id);
        $domain_name     = Domain::getName($intervention->status_id);
        $type_name       = Interventiontype::getName($intervention->type);
        $priority_name   = Priority::getName($intervention->status_id);

        $user = Auth::user();
        $sites = Site::getList();
        $technicians = User::getTechs();
        $domains = Domain::getList();
        $interventionstatuses = Interventionstatus::getList();
        $interventiontypes = Interventiontype::getList();
        $priorities = Priority::getList();
        $types = Time_type::getList();
        $site = Site::find($intervention->site_id);
        $equipments = Equipment::getListBySite($intervention->site_id);
        $equipments_list = Equipment::getListWithNoLinked($intervention->site_id);
        $localisations = Localisation::getList();
        $equipment_types = Equipment_type::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $in_intervention_show = true;
        $in_equipment_show = false;

        return view('pages.intervention.show', compact('intervention', 'site_name', 'assigned_name', 'planneur_name', 'status_name', 'domain_name', 'type_name', 'priority_name', 'sites', 'technicians', 'domains', 'interventionstatuses', 'interventiontypes', 'priorities', 'types','assigned', 'equipments', 'in_intervention_show', 'user', 'in_equipment_show', 'localisations', 'equipment_types', 'brands', 'o_statuses', 'equipments_list', 'site'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $intervention = Intervention::find($id);

        return response::json($intervention);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InterventionRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $intervention = Intervention::find($id);
        $intervention->site_id       = $request->Site;
        $intervention->assigned_id = $request->Assigned;
        $intervention->domain_id     = $request->Domain;
        $intervention->reference_WO  = $request->ReferenceWO;
        $intervention->status_id     = $request->Interventionstatus;
        $intervention->type          = $request->Interventiontype;
        $intervention->request       = $request->Request;
        $intervention->priority_id   = $request->Priority;
        $intervention->save();
        
        if ($request->ajax())
        {
            if ($intervention){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('intervention.Modify'));

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        // Mettre en soft-delete
        $intervention = Intervention::find($id);
        $intervention->deleted_at = Carbon::now();
        $intervention->save();

        if ($request->ajax())
        {
            if ($intervention){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('intervention.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
