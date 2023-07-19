<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\AnalyseController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ExportController;

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
Route::get('/sql', [ExportController::class, 'exportSQL'])->name('eleven');
Route::get('/pdf', [ExportController::class, 'exportPDF'])->name('twelve');

/*
Route::resource('/ajax', 'VStickAjaxController',[VStickAjaxController::class]);
Route::post('/ajax', [VStickAjaxController::class, 'dashVerticalStick']);
*/

Route::get('/batonnet_vertical', [DashController::class, 'dashVerticalStick'])->name('four');
Route::post('/batonnet_vertical', [DashController::class, 'dashVerticalStick']);

Route::get('/batonnet_horizontal', [DashController::class, 'dashHorizontalStick'])->name('five');
Route::post('/batonnet_horizontal', [DashController::class, 'dashHorizontalStick']);

Route::get('/histogramme_vertical', [DashController::class, 'dashVerticalHist'])->name('six');
Route::post('/histogramme_vertical', [DashController::class, 'dashVerticalHist']);

Route::get('/histogramme_horizontal', [DashController::class, 'dashHorizontalHist'])->name('seven');
Route::post('/histogramme_horizontal', [DashController::class, 'dashHorizontalHist']);

Route::get('/camamber', [DashController::class, 'dashCircle'])->name('eight');
Route::post('/camamber', [DashController::class, 'dashCircle']);

Route::get('/nuage_de_points', [DashController::class, 'dashCloud'])->name('nine');
Route::post('/nuage_de_points', [DashController::class, 'dashCloud']);

Route::get('/courbes', [DashController::class, 'dashLinear'])->name('ten');
Route::post('/courbes', [DashController::class, 'dashLinear']);