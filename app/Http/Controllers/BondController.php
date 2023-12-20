<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;

class BondController extends Controller
{

    // ppt 20 - 1 채권 전날 잔액 계산기 (전달 포함)
    public function bondPublish(Request $request) {
        $wholeName = $request->wholeName ?? "";
        $bondPublish  = DB::table('T_COST','c')
        ->join('T_MASTER_ICE AS mi', 'c.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'c.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->selectRaw("IDX, WORK_DATE, DEPOSIT, SALES_COST, BALANCE FROM T_COST
        WHERE WORK_DATE  = (select LAST_DAY(NOW() - interval  1 month) LAST_DAY)
        union all
        SELECT IDX, WORK_DATE, DEPOSIT, SALES_COST, BALANCE")
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->whereBetween('WORK_DATE',[$request->startDate, $request->endDate])
        ->orderby('idx','desc')
        ->first();
        print_r($bondPublish->BALANCE);
        //마지막 레코드의 잔액을 DB에서 조회해서 php로 호출한뒤 오늘의 하루입금액-매출액을 계산하여 insert 를 하고 레코드 자체를 화면에 출력한다
    }
    // ppt 20 - 2 채권 상세조회
    public function bondPublishDetail(Request $request) {
        $bondPublishDetail  = DB::table('T_COST','c')
        ->join('T_MASTER_ICE AS mi', 'c.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'c.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'c.STORE_CODE', '=', 'ms.STORE_CODE')
        ->whereIdx($request->idx)
        ->first();
        $response = array('response' => ["message"=> "채권 상세보기", "data"=> $bondPublishDetail], 'success'=> true);
        return Response::json($response, 200);
    }

    //28 도매장별 데이터 조회
    public function wholeSearch($wholeSaleCode) {
        return response()->json($wholeSaleCode,200);
    }
    
    //29 도매장별 특ㄹ정일 데이터조회 (해당일 매출 상세내역)
    public function wholeSearchByDate($wholeSaleCode, $yyyymmdd) {
        print "도매장코드 : ".$wholeSaleCode. " 날짜 : ". $yyyymmdd;
    }
}
