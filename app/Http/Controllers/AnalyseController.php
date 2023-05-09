<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AnalyseController extends Controller
{
    public function dataExtract()
    {
        $path = Session::get('chemin');
        /*$monfichier = fopen(storage_path('app\\public\\').str_replace('/','\\',$path), 'r');
        $ligne = fgets($monfichier);
        $colonnes = explode(',',$ligne);*/
        $data = file(storage_path('app\\public\\').str_replace('/','\\',$path));
        if($data){
            Storage::put('shell/maker.sh','');
            $maker = fopen(storage_path('app\\shell\\').'maker.sh', 'r+');
            fwrite($maker, "#!/bin/sh");
            fwrite($maker, "\ncd ../../../;");
            fwrite($maker, "\nphp artisan make:model Data -m;");
            fclose($maker);
            $mig = system(storage_path('app\\shell\\').'maker.sh');
            dd($mig);
        }
        return view('extract',['data'=>$data]);
    }
}
