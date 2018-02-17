<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Brand;
use App\Models\Equipment;
use App\Models\Equipment_type;
use App\Models\Intervention;
use App\Models\Localisation;
use App\Models\Order;
use App\Models\Order_status;
use App\Models\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $user = Auth::user();
        $site = Site::find($site_id);
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getListWithNoLinked($site_id);
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListperSite($site_id);
        $in_equipment_show = false;
        $in_intervention_show = false;
        $ordermenu = false;
        return view('pages.order.index', compact('site', 'equipment_types', 'equipments_list', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'user', 'in_intervention_show', 'ordermenu'));
    }

    public function listajax($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $orders = Order::getAllBySite($site_id);
        $users = User::getUsersName();
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getListWithNoLinked($site_id);
        $equipments_loc = Equipment::getLocalisations();
        $equipments_ty = Equipment::getTypes();
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListperSite($site_id);
        $in_equipment_show = false;
        $in_intervention_show = false;
        $ordermenu = false;
        return view('pages.order.listajax', compact('orders', 'equipment_types', 'equipments_list', 'equipments_loc', 'equipments_ty', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'in_intervention_show', 'ordermenu', 'users'));
    }

    public function ordersindex()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $user = Auth::user();
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getList();
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListWithNoLinked();
        $in_equipment_show = false;
        $in_intervention_show = false;
        $ordermenu = false;
        return view('pages.order.index', compact('equipment_types', 'equipments_list', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'user', 'in_intervention_show', 'ordermenu'));
    }

    public function listajaxorders()
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $user = Auth::user();
        if($user->isTech())
        {
            $orders = Order::getAllByUser($user->id);  
        } else {
            $orders = Order::getAll();
        }

        $sites = Site::getList();
        $users = User::getUsersName();
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getList();
        $equipments_loc = Equipment::getLocalisations();
        $equipments_ty = Equipment::getTypes();
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListWithNoLinked();
        $in_equipment_show = false;
        $in_intervention_show = false;
        $ordermenu = true;

        return view('pages.order.listajax', compact('orders', 'equipment_types', 'equipments_list', 'equipments_loc', 'equipments_ty', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'in_intervention_show', 'ordermenu', 'sites', 'users'));
    }

    public function listajaxequipment($equipment_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $orders = Order::getAllByEquipement($equipment_id);  
        $users = User::getUsersName();
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getListWithNoLinked(Equipment::find($equipment_id)->site_id);
        $equipments_loc = Equipment::getLocalisations();
        $equipments_ty = Equipment::getTypes();
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListperSite(Equipment::find($equipment_id)->site_id);
        $in_equipment_show = true;
        $in_intervention_show = false;
        $ordermenu = false;

        return view('pages.order.listajax', compact('orders', 'equipment_types', 'equipments_list', 'equipments_loc', 'equipments_ty', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'in_intervention_show', 'ordermenu', 'users'));
    }

    public function listajaxintervention($intervention_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        $orders = Order::getAllByIntervention($intervention_id);  
        $users = User::getUsersName();
        $equipment_types = Equipment_type::getList();
        $equipments_list = Equipment::getListWithNoLinked(Intervention::find($intervention_id)->site_id);
        $equipments_loc = Equipment::getLocalisations();
        $equipments_ty = Equipment::getTypes();
        $localisations = Localisation::getList();
        $brands = Brand::getList();
        $o_statuses = Order_status::getList();
        $interventions = Intervention::getListperSite(Intervention::find($intervention_id)->site_id);
        $in_intervention_show = true;
        $in_equipment_show = false;
        $ordermenu = false;

        return view('pages.order.listajax', compact('orders', 'equipment_types', 'equipments_list', 'equipments_loc', 'equipments_ty', 'localisations', 'brands', 'o_statuses', 'in_equipment_show', 'interventions', 'in_intervention_show', 'ordermenu', 'users'));
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
    public function store(OrderRequest $request)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        // Add order in the table
        $order = new Order;
        $order->site_id = $request->site_id;
        $order->user_id = $request->user_id;
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;
        $order->intervention_id = $request->intervention;
        $order->equipment_id = $request->equipment;
        $order->equipment_type_id = 0;
        if($request->equipment_id == 0) {
            $order->localisation_id = $request->localisation;
            $order->equipment_type_id    = $request->equipment_type;
        }             
        
        $order->save();

        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Success'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function equipmentcreate(Request $request, $equipment_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $this->validate($request, array(
            'Order_status' =>  'required|max:255',
            'quantity' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'intervention' => 'required',
        ));

        $order = new Order;
        $equ = Equipment::find($equipment_id);
        $order->site_id = $equ->site_id;
        $order->user_id = $request->user_id;
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;
        $order->intervention_id = $request->intervention;
        $order->equipment_id = $equ->id;
        $order->localisation_id = $equ->localisation_id;  
        
        $order->save();

        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Success'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }

    public function interventioncreate(Request $request, $intervention_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager() && !Auth::user()->isExternContact()) {
            return redirect()->back();
        }

        // TODOMORGAN : validation equipement etc.
        $this->validate($request, array(
            'Order_status' =>  'required|max:255',
            'quantity' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'equipment' => 'required',
        ));

        $order = new Order;
        $order->site_id = $request->site_id;
        $order->user_id = $request->user_id;
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;
        $order->intervention_id = $intervention_id;
        $order->equipment_id = $request->equipment;
        if($request->equipment_id == 0) {
            $order->localisation_id = $request->localisation;
            $order->equipment_type_id    = $request->equipment_type;
        }             
        
        $order->save();

        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Success'));

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
        $order = Order::find($id);

        return response::json($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $order = Order::find($id);
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;
        $order->intervention_id = $request->intervention;
        $order->equipment_id = $request->equipment;
        if($request->equipment_id == 0) {
            $order->localisation_id = $request->localisation;
            $order->equipment_type_id    = $request->equipment_type;
        } else {
            $equ = Equipment::find($request->equipment);
            if ($equ) {
                $order->equipment_type_id = $equ->equipment_type_id;
            } else {
                $order->equipment_type_id = 0;
            }
        }       
       
        $order->save();
        
        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Modify'));

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
            'Order_status' =>  'required|max:255',
            'quantity' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'intervention' => 'required',
        ));

        $order = Order::find($id);
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;    
        $order->intervention_id = $request->intervention;
       
        $order->save();
        
        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Modify'));

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
            'Order_status' =>  'required|max:255',
            'quantity' => 'required',
            'brand' => 'required',
            'material' => 'required',
            'equipment' => 'required',
        ));

        $order = Order::find($id);
        $order->status_id = $request->Order_status;
        $order->quantity = $request->quantity;
        $order->reference = $request->reference;
        $order->brand_id = $request->brand;
        $order->material = $request->material;
        $order->model = $request->model;
        $order->comment = $request->comment;
        $order->equipment_id = $request->equipment;
        if($request->equipment_id == 0) {
            $order->localisation_id = $request->localisation;
            $order->equipment_type_id    = $request->equipment_type;
        } else {
            $equ = Equipment::find($request->equipment);
            if ($equ) {
                $order->equipment_type_id = $equ->equipment_type_id;
            } else {
                $order->equipment_type_id = 0;
            }
        }       
       
        $order->save();
        
        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Modify'));

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
        $order = Order::find($id);
        $order->deleted_at = Carbon::now();
        $order->save();

        if ($request->ajax())
        {
            if ($order){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
