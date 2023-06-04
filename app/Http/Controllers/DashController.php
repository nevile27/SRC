<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donnee;
use App\Models\StatFunc;
use Illuminate\Http\Response;
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
            if (in_array($type, ['int', 'bigint', 'float', 'double', 'real', 'decimal'])) {
                array_push($maxs, Donnee::max($colonnes[$key]));
                array_push($mins, Donnee::min($colonnes[$key]));
                array_push($moys, Donnee::avg($colonnes[$key]));
                array_push($ects, $statFunc->ecarType($data->pluck($colonnes[$key])->toArray()));
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

    public function dashVerticalStick(Request $request)
    {
        $statFunc = new StatFunc();
        //$model = new ();
        $data = Donnee::all();
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        $xData = $yData = [];
        if ($request->has('h')) {
            $x = $request->x;
            $y = [];
            $yName = [];
            $inputs = $request->input();
            foreach ($inputs as $key => $input) {
                if(str_contains($key,'y')){
                    array_push($y,$request->input($key));
                    array_push($yName,$colonnes[$input]);
                }
            }
            foreach ($y as $val) {
                array_push($yData,$data->pluck($colonnes[$val])->toArray());
            }
            $xData = $data->pluck($colonnes[$x])->toArray();
            $rep = [
                'x' => $xData,
                'y' => $yData,
                'yName' => $yName,
            ];
            return response()->json($rep); //->withCallback($request->input('callback'))
        } else {
            /*
                x
                foreach ($types as $key => $type) {
                    if (in_array($type, ['int', 'bigint', 'float', 'double', 'real', 'decimal'])) {
                        array_push($y, $key);
                        break;
                    }
                }
            */
        }
        return view('dash_v_stick', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ]);
    }

    public function dashHorizontalStick(Request $request)
    {
        $statFunc = new StatFunc();
        //$model = new ();
        $data = Donnee::all();
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        $xData = $yData = [];
        if ($request->has('h')) {
            $y = $request->y;
            $x = [];
            $xName = [];
            $inputs = $request->input();
            foreach ($inputs as $key => $input) {
                if(str_contains($key,'x')){
                    array_push($x,$request->input($key));
                    array_push($xName,$colonnes[$input]);
                }
            }
            foreach ($x as $val) {
                array_push($xData,$data->pluck($colonnes[$val])->toArray());
            }
            $yData = $data->pluck($colonnes[$y])->toArray();
            $rep = [
                'x' => $xData,
                'y' => $yData,
                'xName' => $xName,
            ];
            return response()->json($rep); //->withCallback($request->input('callback'))
        } else {
            
        }
        return view('dash_h_stick', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ]);
    }

    public function dashVerticalHist(Request $request)
    {
        $statFunc = new StatFunc();
        //$model = new ();
        $data = Donnee::all();
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        $xData = $yData = [];
        if ($request->has('h')) {
            $x = [];
            $xName = [];
            $inputs = $request->input();
            foreach ($inputs as $key => $input) {
                if(str_contains($key,'x')){
                    array_push($x,$request->input($key));
                    array_push($xName,$colonnes[$input]);
                }
            }
            foreach ($x as $val) {
                array_push($xData,$data->pluck($colonnes[$val])->toArray());
            }
            $mode = $request->mode;
            $rep = [
                'x' => $xData,
                'xName' => $xName,
                'mode' => $mode,
            ];
            return response()->json($rep); //->withCallback($request->input('callback'))
        } else {
            
        }
        return view('dash_v_hist', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ]);
    }

    public function dashHorizontalHist(Request $request)
    {
        $statFunc = new StatFunc();
        //$model = new ();
        $data = Donnee::all();
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        $xData = $yData = [];
        if ($request->has('h')) {
            $y = [];
            $yName = [];
            $inputs = $request->input();
            foreach ($inputs as $key => $input) {
                if(str_contains($key,'y')){
                    array_push($y,$request->input($key));
                    array_push($yName,$colonnes[$input]);
                }
            }
            foreach ($y as $val) {
                array_push($yData,$data->pluck($colonnes[$val])->toArray());
            }
            $mode = $request->mode;
            $rep = [
                'y' => $yData,
                'yName' => $yName,
                'mode' => $mode,
            ];
            return response()->json($rep); //->withCallback($request->input('callback'))
        } else {
            
        }
        return view('dash_v_hist', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ]);
    }
}
