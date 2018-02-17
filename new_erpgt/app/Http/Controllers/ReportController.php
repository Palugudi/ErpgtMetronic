<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Document_type;
use App\Models\Equipment;
use App\Models\Intervention;
use App\Models\Report;
use App\Models\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function index($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $user = Auth::user();
        $site = Site::find($site_id);
        $equipments = Equipment::getListBySite($site_id);
        $interventions = Intervention::getListperSite($site_id);
        $in_intervention_show = false;
        $in_equipment_show = false;
        $reportmenu = false;
        return view('pages.report.index', compact('site', 'equipments', 'user', 'interventions', 'in_intervention_show', 'in_equipment_show', 'reportmenu'));
    }

    public function reportsindex()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $equipments = Equipment::getList();
        $interventions = Intervention::getList();
        $in_intervention_show = false;
        $in_equipment_show = false;
        $reportmenu = false;

        return view('pages.report.index', compact('user', 'in_intervention_show', 'in_equipment_show', 'equipments', 'interventions', 'reportmenu'));
    }

    public function listajaxreports()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $user = Auth::user();
        if($user->isTech())
        {
            $reports = Report::getAllByUser($user->id);
        } else {
            $reports = Report::getAll();
        }


        $users = User::getUsersName();
        $sites = Site::getList();
        $equipments = Equipment::getList();
        $interventions = Intervention::getListWithNoLinked();
        $in_intervention_show = false;
        $in_equipment_show = false;
        $reportmenu = true;
        return view('pages.report.listajax', compact('reports', 'users', 'equipments', 'interventions', 'in_intervention_show', 'in_equipment_show', 'reportmenu', 'sites'));
    }

    public function listajax($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $reports = Report::getAllBySite($site_id);
        $users = User::getUsersName();
        $equipments = Equipment::getList();
        $interventions = Intervention::getListperSite($site_id);
        $in_intervention_show = false;
        $in_equipment_show = false;
        $reportmenu = false;
        return view('pages.report.listajax', compact('reports', 'users', 'equipments', 'interventions', 'in_intervention_show', 'in_equipment_show', 'reportmenu'));
    }

    public function listajaxintervention($intervention_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $reports = Report::getAllByIntervention($intervention_id);
        $users = User::getUsersName();
        $equipments = Equipment::getList();
        $in_intervention_show = true;
        $in_equipment_show = false;
        $reportmenu = false;
        return view('pages.report.listajax', compact('reports', 'users', 'equipments', 'in_intervention_show', 'in_equipment_show', 'reportmenu'));
    }

    public function listajaxequipment($equipment_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $reports = Report::getAllByEquipment($equipment_id);
        $users = User::getUsersName();
        $equipments = Equipment::getList();
        $interventions = Intervention::getListperSite(Equipment::find($equipment_id)->site_id);
        $in_intervention_show = false;
        $in_equipment_show = true;
        $reportmenu = false;
        return view('pages.report.listajax', compact('reports', 'users', 'equipments', 'in_intervention_show', 'in_equipment_show', 'interventions', 'reportmenu'));
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
    public function store(ReportRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        // Add report in the table
        $report = new Report;
        $report->user_id    = $request->user_id;
        $report->equipment_id = $request->Equipment;

        $equ = Equipment::find($request->Equipment);
        $report->site_id = $equ->site_id;

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
       
        $report->intervention_id = $request->Intervention;
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();

        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Success'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function interventioncreate(Request $request, $intervention_id)
    {   
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'ReportDate'        =>  'required|max:255',
            'Equipment'        =>  'required|max:255',
            'Flaw'        =>  'required|max:255',
            'Cause'        =>  'required|max:255',
            'Solution'        =>  'required|max:255',
        ));

        $report = new Report;
        $report->user_id    = $request->user_id;
        $report->equipment_id = $request->Equipment;

        $equ = Equipment::find($request->Equipment);
        $report->site_id = $equ->site_id;

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
       
        $report->intervention_id = $intervention_id;
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();

        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Success'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function equipmentcreate(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'ReportDate'        =>  'required|max:255',
            'Flaw'        =>  'required|max:255',
            'Cause'        =>  'required|max:255',
            'Solution'        =>  'required|max:255',
            'Intervention'   =>   'required|max:255',
        ));

        $report = new Report;
        $report->user_id    = $request->user_id;
        $report->equipment_id = $id;

        $equ = Equipment::find($id);
        $report->site_id = $equ->site_id;

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
       
        $report->intervention_id = $request->Intervention;
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();

        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Success'));

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
        $report = Report::find($id);
        $equipments = Equipment::getList();
        $interventions = Intervention::getListperSite($report->site_id);
        $users = User::getUsersName();
        $sites = Site::getList();
        $document_types = Document_type::getList();

        return view('pages.report.show', compact('report', 'equipments', 'interventions', 'users', 'sites', 'document_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);

        return response::json($report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $report = Report::find($id);

        $report->equipment_id = $request->Equipment;

        $equ = Equipment::find($request->Equipment);

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
        
        $report->intervention_id = $request->Intervention;
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();
        
        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Modify'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function interventionupdate(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'ReportDate'        =>  'required|max:255',
            'Equipment'        =>  'required|max:255',
            'Flaw'        =>  'required|max:255',
            'Cause'        =>  'required|max:255',
            'Solution'        =>  'required|max:255',
        ));

        $report = Report::find($id);

        $report->equipment_id = $request->Equipment;

        $equ = Equipment::find($request->Equipment);

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
        
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();
        
        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Modify'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function equipmentupdate(Request $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'ReportDate'        =>  'required|max:255',
            'Flaw'        =>  'required|max:255',
            'Cause'        =>  'required|max:255',
            'Solution'        =>  'required|max:255',
            'Intervention'   =>   'required|max:255',
        ));

        $report = Report::find($id);

        $equ = Equipment::find($request->Equipment);

        if(Session()->get('locale') == 'en') {
            $carb = Carbon::createFromFormat('m/d/Y',$request->ReportDate); 
        } elseif (Session()->get('locale') == 'fr') {
            $carb = Carbon::createFromFormat('d/m/Y',$request->ReportDate); 
        }
        
        $report->intervention_id = $request->Intervention;
        $report->date = $carb->format('Y-m-d');
        $report->flaw = $request->Flaw;
        $report->cause = $request->Cause;
        $report->solution = $request->Solution;
        $report->save();
        
        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Modify'));

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
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        // Mettre en soft-delete
        $report = Report::find($id);
        $report->deleted_at = Carbon::now();
        $report->save();

        if ($request->ajax())
        {
            if ($report){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('report.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
