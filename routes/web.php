<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AnalyseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('upload');
});
Route::post('/', [UploadController::class, 'verif_up']);
Route::get('/extraction', [AnalyseController::class, 'dataExtract'])->name('first');
Route::get('/rapport', [AnalyseController::class, 'dataPresentation'])->name('second');
