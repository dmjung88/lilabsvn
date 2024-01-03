<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\EmpLoginController;
use App\Http\Controllers\GridController;
use App\Http\Controllers\MasterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route::get('/URL',['as'=>'prfix.method', 'uses'=>'Controller@method']);
| Route::post('/URL','Controller@index')->name('prfix.index');
|
*/

Route::any('/', function () {
    return view('welcome');
});

//Auth::routes();
Route::any('/model/CustomMethod', [App\Http\Controllers\HomeController::class, 'modelCustomMethod']);
Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard',[SignUpController::class, 'dashboard'])->middleware('authCheck');

Route::prefix('auth')->name('auth.')->middleware(['authCheck'])->group(function () {
    Route::get('/login',[SignUpController::class, 'getLogin'])->name('getLogin');
    Route::get('/register',[SignUpController::class, 'getRegister'])->name('getRegister');
    Route::post('/login',[SignUpController::class, 'postLogin'])->name('postLogin');
    Route::post('/register',[SignUpController::class, 'postRegister'])->name('postRegister');
    Route::match(['get','post'], '/logout',[SignUpController::class, 'logout'])->name('logout');
});

//로그인 
Route::get('/personalLogin',[EmpLoginController::class, 'personalLogin'])->name('personalLogin');
Route::get('/companyLogin',[EmpLoginController::class, 'companyLogin'])->name('companyLogin');

//데이터 엑셀다운
Route::get('tax/exportToExcel',[TaxController::class, 'exportToExcel']);
//데이터 PDF 다운
Route::get('tax/exportPdf',[TaxController::class, 'exportPdf']);
//email 보내기
//https://www.youtube.com/watch?v=TRH5cDOa53w
Route::get('tax/eMailSend',[TaxController::class, 'eMailSend']);
//email + pdf 보내기
//https://www.youtube.com/watch?v=60jEIQ8LtS0
Route::get('tax/attachSend',[TaxController::class, 'attachSend']);

//토스트 JQ UI grid
Route::get('front/toastuigrid',[GridController::class, 'toastuigrid']);
Route::get('front/gridData',[GridController::class, 'gridData'])->name('front.gridData');
Route::get('front/jqgrid',[GridController::class, 'jqgrid']);
Route::get('front/jqgriddata',[GridController::class, 'jqgriddata'])->name('jqgriddata');;
Route::get('front/officialgrid',[GridController::class, 'officialgrid']);
Route::get('front/buttonData',[GridController::class, 'buttonData']);

// 마스터 return View
Route::prefix('master')->group(function() {  
    Route::get('wholeAdd',[MasterController::class, 'wholeAddView'])->name('master.wholeAdd');
    Route::post('bizNumCheck',[MasterController::class, 'bizNumCheck'])->name('master.bizNumCheck');
});