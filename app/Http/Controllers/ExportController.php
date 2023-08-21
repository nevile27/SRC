<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\StatFunc;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExportController extends Controller
{
    public function exportSQL()
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }

        if(strtoupper(substr(PHP_OS, 0, 3)) == "WIN"){
            $s = "\\";
        }else{
            $s = "/";
        }

        $prefix = Session::get('prefixe');
        $export = system(storage_path('app'.$s.'shell'. $s) . 'export.sh ' . $prefix . 's ' . env('DB_CONNECTION') . ' ' . env('DB_DATABASE') . ' ' . env('DB_USERNAME') . ' ' . env('DB_PASSWORD'), $exit_code);
        return ($exit_code != 0)? view('error',['error'=>9]):(($export=="no")?view('error',['error'=>10]):response()->download(storage_path('app'.$s.'public'.$s.'sql'. $s . $prefix . 's.sql')));
    }

    public function exportPDF(Request $request)
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefixe = Session::get('prefixe');
        ob_start();
        $statFunc = new StatFunc();
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $colonne = ($request->colonne) ? $request->colonne:'id';
        $ordre = ($request->ordre) ? $request->ordre:'asc';
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
        $html = view('pdf', [
            'data' => $data->orderBy($colonne, $ordre)->get()->toArray(),
            'colonnes' => $colonnes,
            'types' => $types,
            'sums' => $sums,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
            'colonne' => $colonne,
            'ordre' => $ordre,
        ])->render();
        ob_end_clean();

        include_once('.././vendor/autoload.php');
        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $options->set('chroot',realpath(''));
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();

        $fichier = $prefixe . 's.pdf';

        $dompdf->stream($fichier);

        return redirect(route('third'));
    }
}
