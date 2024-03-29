<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatFunc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashController extends Controller
{
    //Donnee
    public function dashTab(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $colonnes = Session::get('colonnes');
        $types = Session::get('types');
        $colonne = ($request->colonne) ? $request->colonne:'id';
        $ordre = ($request->ordre) ? $request->ordre:'asc';
        $debut = ($request->debut) ? $request->debut:0;
        $limit = ($request->limit) ? $request->limit:500;

        $statFunc = new StatFunc();
        $sums = $maxs = $mins = $moys = $ects = [];
        foreach ($types as $key => $type) {
            if (in_array($type, ['int', 'bigint', 'float', 'double', 'real', 'decimal'])) {
                array_push($sums, $data->sum($colonnes[$key]));
                array_push($maxs, $data->max($colonnes[$key]));
                array_push($mins, $data->min($colonnes[$key]));
                array_push($moys, $data->avg($colonnes[$key]));
                array_push($ects, $statFunc->ecarType($data->pluck($colonnes[$key])->toArray()));
            }
        }
        return view('dash_tab', [
            'data' => $data->orderBy($colonne, $ordre)->offset($debut)->limit($limit)->get()->toArray(),
            'colonnes' => $colonnes,
            'types' => $types,
            'sums' => $sums,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
            'colonne' => $colonne,
            'ordre' => $ordre,
            'debut' => $debut,
            'limit' => $limit,
            'compte' => $data->getCountForPagination(['id']),
            'route' => 'third',
        ]);
    }

    public function dashVerticalStick(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        
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
            return response()->json($rep);
        }
        return view('dash_v_stick', [
            'colonnes' => $colonnes,
            'route' => 'four',
        ]);
    }

    public function dashHorizontalStick(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        
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
            return response()->json($rep);
        }
        return view('dash_h_stick', [
            'colonnes' => $colonnes,
            'route' => 'five',
        ]);
    }

    public function dashVerticalHist(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');

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
            return response()->json($rep);
        }
        return view('dash_v_hist', [
            'colonnes' => $colonnes,
            'route' => 'six',
        ]);
    }

    public function dashHorizontalHist(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        
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
            return response()->json($rep);
        }
        return view('dash_h_hist', [
            'colonnes' => $colonnes,
            'route' => 'seven',
        ]);
    }

    public function dashCircle(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');

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
            return response()->json($rep);
        }
        return view('dash_circle', [
            'colonnes' => $colonnes,
            'route' => 'eight',
        ]);
    }
    
    public function dashCloud(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');

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
                'mode' => $request->mode,
            ];
            return response()->json($rep);
        }
        return view('dash_cloud', [
            'colonnes' => $colonnes,
            'route' => 'nine',
        ]);
    }
    
    public function dashLinear(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        
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
                'mode' => $request->mode,
                'forme' => $request->forme,
            ];
            return response()->json($rep);
        }
        return view('dash_linear', [
            'colonnes' => $colonnes,
            'route' => 'ten',
        ]);
    }
}
