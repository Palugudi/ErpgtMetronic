<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order_statusRequest;
use App\Models\Order_status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Order_statusController extends Controller
{
    public function index()
    {
        return view('pages.order_status.index');
    }

    public function listajax()
    {
        $order_statuss = Order_status::getAll();
        return view('pages.order_status.listajax', compact('order_statuss'));
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
    public function store(Order_statusRequest $request)
    {

        $order_status = Order_status::where('name', $request->Order_status)->first();
        $delete = Order_status::where('name', $request->Order_status)->whereNotNull('deleted_at')->first();

        if($order_status != null) {
            if($delete) {
                $order_status->deleted_at = null;
                $order_status->save();
            } else {
                $this->validate($request, array(
                    'Order_status' => 'required|max:255|unique:order_statuses,name'
                ));
            }
        } else {
            // Add order_status in the table
            $order_status = new Order_status;
            $order_status->name    = $request->Order_status;
            $order_status->save();
        }

        if ($request->ajax())
        {
            if ($order_status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order_status.Success'));

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
        $order_status = Order_status::find($id);

        return response::json($order_status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Order_statusRequest $request, $id)
    {
        $order_status = Order_status::find($id);
        $order_status->name      = $request->Order_status;
        $order_status->save();
        
        if ($request->ajax())
        {
            if ($order_status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order_status.Modify'));

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
        // Mettre en soft-delete
        $order_status = Order_status::find($id);
        $order_status->deleted_at = Carbon::now();
        $order_status->save();

        if ($request->ajax())
        {
            if ($order_status){
                return Response::json(['success' => 'true']);
            }else {
                return Response::json(['success' => 'false']);
            }
            
        } else{
            // Renseigner un message flash
            Session::flash('success', trans('order_status.Delete'));

            // Rediriger vers une page
            return redirect()->back();
        }
    }
}
