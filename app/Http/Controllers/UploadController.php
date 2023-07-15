<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function verif_up(Request $request)
    {
        $request->validate([
            'fichier' => 'required|file|mimetypes:text/csv,text/plain|max:2000',
        ]);
        // circonstance, élément, information, postulat, précision, principe, renseignement.
        $prefix = "donnee";
        $path = $request->file('fichier')->storeAs('csv', $prefix.'.csv', 'public');
        Session::put('chemin', $path);
        Session::put('prefixe', $prefix);
        return view('upload',['path'=>$path]);
    }
}
