<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveFile($data, $name, $destinationPath)
    {
        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777,true);
        }
        $fileName = $name;
        $path = $destinationPath.$fileName;
        $outputData = isset($data->output->image) ?base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data->output->image)) : null;
        if(file_put_contents($path, $outputData)) {
            return true;
        } else {
            return false;
        }
    }
}
