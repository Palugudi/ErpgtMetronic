<?php

use Carbon\Carbon;
	
if(!function_exists('format_date')){
	function format_date($date) {
		if(Session()->get('locale') == 'fr') {
			Carbon::setLocale('fr');
		} else {
			Carbon::setLocale('en');
		}
		return $date->diffForHumans();
	}
}

if(!function_exists('remove_accents')){
	function remove_accents($string, $charset='utf-8')
	{
	    $string = htmlentities($string, ENT_NOQUOTES, $charset);
	    
	    $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
	    $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string); // pour les ligatures e.g. '&oelig;'
	    $string = preg_replace('#&[^;]+;#', '', $string); // supprime les autres caractères
	    $string = str_replace("'", '-', $string); // supprime les '
	    $string = str_replace('"', '', $string); // supprime les "
	    $string = str_replace(' ', '-', $string); // supprime les espaces
	    
	    return $string;
	}
}

// Afficher la date avec le format Français
if(!function_exists('format_date_simple')){
	function format_date_simple($date) {
		if ($date <> null ){
			$CarbonDate = Carbon::createFromFormat('Y-m-d', $date);
			if(Session()->get('locale') == 'en') {
				return $CarbonDate->format('m/d/Y');
			} 
			return $CarbonDate->format('d/m/Y');
		}
		return "";
	}
}

// Afficher la date avec le format Français depuis un timestamp
if(!function_exists('format_date_simple_fromTS')){
	function format_date_simple_fromTS($date) {
		if ($date <> null ){
			$CarbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $date);
			return $CarbonDate->format('d/m/Y');
		}
		return "";
	}
}