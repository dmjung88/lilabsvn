<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BondController;
use App\Http\Controllers\TaxController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| 응용 프로그램의 API 경로를 등록할 수 있는 곳입니다
| 루트가 그룹 내에서 RouteServiceProvider에 의해 로드됩니다
| 'API' 미들웨어 그룹으로 지정되었습니다. API 구축을 즐겨보세요!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//CommonController
Route::prefix('common')->group(function () {
    Route::post('/search/wholesale', [CommonController::class, 'wholeSaleSearch']);
    Route::post('/search/wholesaleBizNum', [CommonController::class, 'wholesaleBizNumSearch']);
    Route::post('/search/store', [CommonController::class, 'storeSearch']);
    Route::post('/search/goods', [CommonController::class, 'goodsSearch']);
    Route::post('/search/maker', [CommonController::class, 'makerSearch']);
    Route::post('/search/goodsType', [CommonController::class, 'goodsType']);
    Route::post('/view/wholesaleEmail', [CommonController::class, 'wholesaleEmailCheck']);
    Route::post('/search/fix', [CommonController::class, 'fixDataSearch']);
    Route::get('/mypage', [CommonController::class, 'myPage']);
    Route::post('/emp/save', [CommonController::class, 'empSave']);

});

//MasterController
Route::prefix('master')->group(function () {

    //입력 모드
    Route::post('/wholesale', [MasterController::class, 'wholesaleSave']);
    Route::post('/store', [MasterController::class, 'storeSave']);
    Route::post('/goods', [MasterController::class, 'goodsSave']);
    Route::post('/fix', [MasterController::class, 'fixSave']);
    Route::post('/employee', [MasterController::class, 'employeeSave']);

    //수정 모드
    Route::post('/wholesaleUpdate', [MasterController::class, 'wholeSaleUpdate']);
    Route::post('/storeUpdate', [MasterController::class, 'storeUpdate']);
    Route::post('/goodsUpdate', [MasterController::class, 'goodsUpdate']);
    Route::post('/fixUpdate', [MasterController::class, 'fixUpdate']);

});

//WorkController
Route::prefix('work')->group(function () {
    Route::post('/receive', [WorkController::class, 'receiveSave'])->name('work.receiveSave');
    Route::post('/codeSearch', [WorkController::class, 'codeSearch'])->name('work.codeSearch');
    Route::post('/salesSave', [WorkController::class, 'salesSave'])->name('work.salesSave');
    Route::post('/workProSave', [WorkController::class, 'workProSave'])->name('work.workProSave');
    Route::post('/workModify', [WorkController::class, 'workModify'])->name('work.workModify');
});

//ReportController
Route::prefix('report')->group(function() {
    Route::get('/reportNewSearch', [ReportController::class, 'reportNewSearch'])->name('report.reportNewSearch');
    Route::get('/reportNewSearchNoWhole', [ReportController::class, 'reportNewSearchNoWhole'])->name('report.reportNewSearchNoWhole');
    Route::get('/reportStockSearch', [ReportController::class, 'reportStockSearch'])->name('report.reportStockSearch');
    Route::get('/reportStockSearchNoWhole', [ReportController::class, 'reportStockSearchNoWhole'])->name('report.reportStockSearchNoWhole'); 
    Route::get('/reportOutputSearch', [ReportController::class, 'reportOutputSearch'])->name('report.reportOutputSearch');
    Route::get('/reportOutputSearchNoWhole', [ReportController::class, 'reportOutputSearchNoWhole'])->name('report.reportOutputSearchNoWhole'); 
    Route::get('/reportWithdrawalSearch', [ReportController::class, 'reportWithdrawalSearch'])->name('report.reportWithdrawalSearch');
    Route::get('/reportWithdrawalSearchNoWhole', [ReportController::class, 'reportWithdrawalSearchNoWhole'])->name('report.reportWithdrawalSearchNoWhole'); 
    Route::get('/reportTotalSearch', [ReportController::class, 'reportTotalSearch'])->name('report.reportTotalSearch');
    Route::get('/reportTotalSearchNoWhole', [ReportController::class, 'reportTotalSearchNoWhole'])->name('report.reportTotalSearchNoWhole');   
    Route::get('/reporWarrantySearch', [ReportController::class, 'reporWarrantySearch'])->name('report.reporWarrantySearch');
    Route::get('/reportWarrantySearchNoWhole', [ReportController::class, 'reportWarrantySearchNoWhole'])->name('report.reportWarrantySearchNoWhole');     
    Route::get('/clientTotalSearch', [ReportController::class, 'clientTotalSearch'])->name('report.clientTotalSearch');
    Route::get('/clientTotalSearchNoWhole', [ReportController::class, 'clientTotalSearchNoWhole'])->name('report.clientTotalSearchNoWhole');                                    
});

//BondController
Route::prefix('bond')->group(function() {
    Route::get('/{wholesaleCode}', [BondController::class, 'wholeSearch'])->name('bond.wholeSearch');
    Route::get('/{wholesaleCode}/{date}', [BondController::class, 'wholeSearchByDate'])->name('bond.wholeSearchByDate');
});

//TaxController
Route::prefix('taxInvoice')->group(function() {
    Route::get('/{wholesaleCode}', [TaxController::class, 'taxExcelSearch'])->name('tax.taxExcelSearch');
});