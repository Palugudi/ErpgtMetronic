<?php

use App\Models\Equipment;
use App\Models\Key;
use App\Models\Site;
use Illuminate\Database\Seeder;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FoldersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = Site::all();
        foreach($sites as $site) {
        	if (!is_dir(public_path('documents/'.$site->id))) {mkdir(public_path('documents/'.$site->id));};
        	if (!is_dir(public_path('documents/'.$site->id.'/equipments'))) {mkdir(public_path('documents/'.$site->id.'/equipments'));};
        	if (!is_dir(public_path('documents/'.$site->id.'/keys'))) {mkdir(public_path('documents/'.$site->id.'/keys'));}; 
        }

        $keys = Key::all();
        foreach($keys as $key) {
        	if (!is_dir(public_path('documents/'.$key->site_id.'/keys/'.$key->id))) {
        		mkdir(public_path('documents/'.$key->site_id.'/keys/'.$key->id));
        	};
            $qrcode = new BaconQrCodeGenerator;
        	$qrcode->size(80)->generate(URL::to('/key/'.$key->id), public_path('documents/'.$key->site_id.'/keys/'.$key->id.'/qr_code.svg'));
        }


        $equipments = Equipment::all();
        foreach($equipments as $equipment) {
        	if (!is_dir(public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id))) {
        		mkdir(public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id));
        	};
        	$qrcode = new BaconQrCodeGenerator;
            $qrcode->size(80)->generate(URL::to('/equipment/'.$equipment->id), public_path('documents/'.$equipment->site_id.'/equipments/'.$equipment->id.'/qr_code.svg'));
        }
    }
}
                