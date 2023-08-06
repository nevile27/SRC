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
        $prefix = Session::get('prefixe');
        $exec_migrate = system(storage_path('app\\shell\\') . 'export.sh ' . $prefix . 's');
        //DB::statement('SELECT * INTO OUTFILE "'.$path.'" FROM '.$prefix.'s');
        return response()->download(storage_path('app\\public\\sql\\' . $prefix . 's.sql'));
    }

    public function exportPDF()
    {
        if(!Session::has('prefixe')){
            return Redirect('/')->with(["success" => false, "message" => "Votre session a expirée"]);
        }
        $prefix = Session::get('prefixe');
        ob_start();
        $statFunc = new StatFunc();
        $prefixe = Session::get('prefixe');
        $data = DB::table($prefixe . 's');
        $types = Session::get('types');
        $colonnes = Session::get('colonnes');
        $maxs = $mins = $moys = $ects = [];
        foreach ($types as $key => $type) {
            if (in_array($type, ['int', 'bigint', 'float', 'double', 'real', 'decimal'])) {
                array_push($maxs, $data->max($colonnes[$key]));
                array_push($mins, $data->min($colonnes[$key]));
                array_push($moys, $data->avg($colonnes[$key]));
                array_push($ects, $statFunc->ecarType($data->pluck($colonnes[$key])->toArray()));
            }
        }
        $html = view('pdf', [
            'data' => $data->get()->toArray(),
            'colonnes' => $colonnes,
            'types' => $types,
            'maxs' => $maxs,
            'mins' => $mins,
            'moys' => $moys,
            'ects' => $ects,
        ])->render();
        ob_end_clean();
        include_once('.././vendor/autoload.php');
        $options = new Options();
        $options->set('isRemoteEnabled',true);
        $options->set('chroot',realpath(''));

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4','portrait');

        $dompdf->render();

        $fichier = $prefix . 's.pdf';

        $dompdf->stream($fichier);

        return redirect(route('third'));
    }
}
