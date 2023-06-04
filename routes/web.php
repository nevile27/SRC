<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\DashController;

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
Route::get('/tableau', [DashController::class, 'dashTab'])->name('third');
Route::get('/batonnet_vertical', [DashController::class, 'dashVerticalStick'])->name('fourth');
Route::post('/batonnet_vertical', [DashController::class, 'dashVerticalStick']);
/*
Route::resource('/ajax', 'VStickAjaxController',[VStickAjaxController::class]);
Route::post('/ajax', [VStickAjaxController::class, 'dashVerticalStick']);
*/
Route::get('/batonnet_horizontal', [DashController::class, 'dashHorizontalStick'])->name('five');
Route::post('/batonnet_horizontal', [DashController::class, 'dashHorizontalStick']);

Route::get('/histogramme_vertical', [DashController::class, 'dashVerticalHist'])->name('six');
Route::post('/histogramme_vertical', [DashController::class, 'dashVerticalHist']);

Route::get('/histogramme_horizontal', [DashController::class, 'dashHorizontalHist'])->name('seven');
Route::post('/histogramme_horizontal', [DashController::class, 'dashHorizontalHist']);