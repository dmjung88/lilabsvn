<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\TaxController;

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

Route::any('/', function () {
    return view('welcome');
});

Auth::routes();

Route::any('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard',[SignUpController::class, 'dashboard'])->middleware('authCheck');

Route::prefix('auth')->name('auth.')->middleware(['authCheck'])->group(function () {
    Route::get('/login',[SignUpController::class, 'getLogin'])->name('getLogin');
    Route::get('/register',[SignUpController::class, 'getRegister'])->name('getRegister');
    Route::post('/login',[SignUpController::class, 'postLogin'])->name('postLogin');
    Route::post('/register',[SignUpController::class, 'postRegister'])->name('postRegister');
    Route::match(['get','post'], '/logout',[SignUpController::class, 'logout'])->name('logout');
});

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