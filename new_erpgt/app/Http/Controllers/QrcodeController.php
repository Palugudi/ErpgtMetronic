<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Equipment;
use App\Models\Key;
use App\Models\Localisation;
use App\Models\Site;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class QrcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($site_id)
    {
        if (!Auth::user()->isAdmin() && !Auth::user()->isTech() && !Auth::user()->isPlanneur() && !Auth::user()->isFM() && !Auth::user()->isManager()) {
            return redirect()->back();
        }

        $qrcodes_equipments = array();
        $qrcodes_keys = array();

        $equipments = Equipment::where('deleted_at', null)->where('site_id', $site_id)->get();

        foreach($equipments as $equipment) {
            $qrcode = 'documents/'.$site_id.'/equipments/'.$equipment->id.'/qr_code.svg';
            $qrcodes_equipments[$equipment->id]['qrcode'] = $qrcode;
            $qrcodes_equipments[$equipment->id]['name'] = $equipment->equipment_name;
            $qrcodes_equipments[$equipment->id]['localisation'] = Localisation::find($equipment->localisation_id)->name;
        }

        $keys = Key::where('deleted_at', null)->where('site_id', $site_id)->get();

        foreach($keys as $key) {
            $qrcode = 'documents/'.$site_id.'/keys/'.$key->id.'/qr_code.svg';
            $qrcodes_keys[$key->id]['qrcode'] = $qrcode;
            $qrcodes_keys[$key->id]['name'] = $key->key_number;
            $qrcodes_keys[$key->id]['building'] = $key->building;
            $qrcodes_keys[$key->id]['floor'] = $key->floor;
        }

        $equipments_list = Equipment::getList();
        $keys_list = Key::getList();
        $site = Site::find($site_id);

        return view('pages.qrcodes.index', compact('qrcodes_equipments', 'qrcodes_keys', 'equipments_list', 'keys_list', 'site'));
    }

    public function listajax()
    {

        return view('pages.qrcodes.listajax');
    }

    public function printQrcode($site_id)
    {
        $qrcodes_equipments = array();
        $qrcodes_keys = array();

        $equipments = Equipment::where('deleted_at', null)->where('site_id', $site_id)->get();

        foreach($equipments as $equipment) {
            $qrcode = 'documents/'.$site_id.'/equipments/'.$equipment->id.'/qr_code.svg';
            $qrcodes_equipments[$equipment->id]['qrcode'] = $qrcode;
            $qrcodes_equipments[$equipment->id]['name'] = $equipment->equipment_name;
            $qrcodes_equipments[$equipment->id]['localisation'] = Localisation::find($equipment->localisation_id)->name;
        }

        $keys = Key::where('deleted_at', null)->where('site_id', $site_id)->get();

        foreach($keys as $key) {
            $qrcode = 'documents/'.$site_id.'/keys/'.$key->id.'/qr_code.svg';
            $qrcodes_keys[$key->id]['qrcode'] = $qrcode;
            $qrcodes_keys[$key->id]['name'] = $key->key_number;
            $qrcodes_keys[$key->id]['building'] = $key->building;
            $qrcodes_keys[$key->id]['floor'] = $key->floor;
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('pages.qrcodes.listajax', compact('qrcodes_equipments', 'qrcodes_keys'));
        file_put_contents(public_path('documents\qrcodes.pdf'), $pdf->stream());
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
}
