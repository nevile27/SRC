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
            'file' => 'required|file|max:2000',
        ]);
        $path = $request->file('file')->storeAs('test', 'data.csv', 'public');
        Session::put('chemin', $path);
        return view('upload',['path'=>$path]);
    }
}
