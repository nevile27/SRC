<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
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
        
        $html = view('error',['error'=>2])->render();
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
