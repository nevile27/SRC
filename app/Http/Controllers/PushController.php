<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class PushController extends Controller
{
    public function pushData()
    {
        $path = Session::get('chemin');
        $flux = fopen(storage_path('app\\public\\').str_replace('/','\\',$path), 'r');
        $i = 0;
        while(! feof($flux)){
            $data[$i] = fgetcsv($flux);
            $i++;
        }
    }
}
