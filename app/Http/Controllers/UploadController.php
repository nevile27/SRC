<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function verif_up(Request $request)
    {
        $request->validate([
            'fichier' => 'required|file|mimetypes:text/csv,text/plain|max:2000',
        ]);

        $data = DB::table('sessions')->pluck('id')->toArray();
        $prefixes = ["donnee", "circonstance", "element", "information", "postulat", "principe", "renseignement","precision","condition","critère"];
        foreach ($data as $key => $id) {
            if($key >= count($prefixes)){
                return view('error',['error'=>11]);
            }
            if($id == Session::getId()){
                $prefix = $prefixes[$key];
            }
        }
        
        $path = $request->file('fichier')->storeAs('csv', $prefix.'.csv', 'public');
        Session::put('chemin', $path);
        Session::put('prefixe', $prefix);
        
        return view('upload',['path'=>$path]);
    }
}
