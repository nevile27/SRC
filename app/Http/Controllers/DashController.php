<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatFunc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashController extends Controller
{
    //Donnee
    public function dashTab()
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $colonnes = Session::get('colonnes');
        $types = Session::get('types');

        $statFunc = new StatFunc();
        $maxs = $mins = $moys = $ects = [];
        foreach ($types as $key => $type) {
            if (in_array($type, ['int', 'bigint', 'float', 'double', 'real', 'decimal'])) {
                array_push($maxs, $data->max($colonnes[$key]));
                array_push($mins, $data->min($colonnes[$key]));
                array_push($moys, $data->avg($colonnes[$key]));
                array_push($ects, $statFunc->ecarType($data->pluck($colonnes[$key])->toArray()));
            }
        }
        return view('dash_tab', [
            'data' => $data->get()->toArray(),
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
            'route' => 'third',
        ]);
    }

    public function dashVerticalStick(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
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
            'route' => 'four',
        ]);
    }

    public function dashHorizontalStick(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
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
            'route' => 'five',
        ]);
    }

    public function dashVerticalHist(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
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
            'route' => 'six',
        ]);
    }

    public function dashHorizontalHist(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
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
            'route' => 'seven',
        ]);
    }

    public function dashCircle(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
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
            
        }
        return view('dash_circle', [
            'data' => $data,
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
            'route' => 'eight',
        ]);
    }
    
    public function dashCloud(Request $request)
    {
        # code...
    }
    
    public function dashLinear(Request $request)
    {
        # code...
    }
}
