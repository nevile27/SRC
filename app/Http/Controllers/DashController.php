<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donnee;
use App\Models\StatFunc;
use Illuminate\Support\Facades\Session;

class DashController extends Controller
{
    //Donnee
    public function dashTab()
    {
        $statFunc = new StatFunc();
        //$model = new ();
        $data = Donnee::all();
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        foreach ($types as $key => $type) {
            if(in_array($type,['int','bigint','float','double','real','decimal'])){
                array_push($maxs,Donnee::max($colonnes[$key]));
                array_push($mins,Donnee::min($colonnes[$key]));
                array_push($moys,Donnee::avg($colonnes[$key]));
                array_push($ects,$statFunc->ecarType($data->pluck($colonnes[$key])->toArray()));
            }
        }
        return view('dash_tab', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ]);
    }

    public function dashVerticalStick()
    {
        return view('dash_v_stick');
    }

    public function dashHorizontalStick()
    {
        return view('dash_h_stick');
    }
}
