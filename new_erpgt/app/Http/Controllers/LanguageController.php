<?php

namespace App\Http\Controllers;

use App;
use Lang;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request) {
    	if ($request->ajax()) {
    		$request->session()->put('locale',$request->locale);
    		$request->session()->flash('alert-success',('app.Locale_Change_Success'));
    	}
    }
}

