<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Session;

class ReportController extends Controller
{
    // 발행 ppt 12
    public function reportNewSearch(Request $request) {
        $wholeName = $request->wholeName ?? '';
        $empGroup =  Session::get('empGroup');
        if($empGroup == "C") { // 냉동회사의 경우
            $empCode = '';
        } else { // 수리기사의 경우
            $empCode = Session::get('empCode');
        }

        $newPurchStat = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_NAME","ms.STORE_ADDRESS","ms.STORE_PHONE","mg.GOODS_NAME"
        ,"mg.GOODS_MODEL_YEAR","mg.GOODS_DIV","ms.NOTE","fc.SALES_COST" )
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->where("me.EMP_CODE", $empCode)
        ->orderBy('fc.IDX', 'asc')
        ->get();
        
        $response = array('response' => ["message"=> "발행-신품 : 조회일자 + 도매장 으로 검색", "data"=> $newPurchStat], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 13 재고현황 조회 (날짜 + 도매장)
    public function reportStockSearch(Request $request) {
        $wholeName = $request->wholeName ?? '';

        $stockStat = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_NAME","ms.STORE_PHONE","mg.GOODS_NAME","mg.GOODS_MODEL_YEAR"
        ,"wc.WORK_TXT","fc.FIX_NAME","fc.SALES_COST")
        ->selectRaw("(CASE wc.WORK_CODE 
        WHEN 00 THEN '판매' WHEN 10 THEN '입고' WHEN 20 THEN '수리대기' WHEN 21 THEN '수리완료' WHEN 90 THEN '폐기'
        WHEN 29 THEN '수리불가' WHEN 30 THEN '출고' WHEN 40 THEN '현장수리' WHEN 41 THEN '외주위탁수리'
        ELSE wc.WORK_CODE END) AS WORK_CODE")
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%$wholeName%")
        ->orderBy('fc.IDX', 'asc')
        ->get();
        $response = array('response' => ["message"=> "재고현황 : 조회일자 + 도매장명 으로 검색", "data"=> $stockStat], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 15 중고품 간편출고 현황
    public function reportOutputSimple(Request $request) {
        $wholeName = $request->wholeName ?? '';
        $empGroup =  Session::get('empGroup');
        if($empGroup == "C") { // 냉동회사의 경우
            $empCode = '';
        } else { // 수리기사의 경우
            $empCode = Session::get('empCode');
        }

        $simpleRelease  = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_CODE","ms.STORE_ADDRESS","mg.GOODS_NAME","mg.GOODS_MODEL_YEAR"
        ,"wc.WORK_CODE","wc.WORK_TXT","wc.WORK_MANAGE","fc.FIX_NAME","fc.SALES_COST" )
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->where("me.EMP_CODE", $empCode)
        ->orderBy('fc.IDX', 'asc')
        ->get();

        $response = array('response' => ["message"=> "간편출고현황 검색", "data"=> $simpleRelease], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 16 중고품 회수출고 현황
    public function recallAfterRelease(Request $request) {
        $wholeName = $request->wholeName ?? '';
        $empGroup =  Session::get('empGroup');
        if($empGroup == "C") { // 냉동회사의 경우
            $empCode = '';
        } else { // 수리기사의 경우
            $empCode = Session::get('empCode');
        }

        $recallAfterRelease  = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_NAME","ms.STORE_ADDRESS","mg.GOODS_MODEL_YEAR","wc.WORK_CODE"
        ,"wc.WORK_MANAGE","wc.WORK_TXT","fc.FIX_NAME","fc.SALES_COST","mg.GOODS_NAME" )
        ->selectRaw("(CASE wc.WORK_CODE 
        WHEN 00 THEN '판매' WHEN 10 THEN '입고' WHEN 20 THEN '수리대기' WHEN 21 THEN '수리완료' WHEN 90 THEN '폐기'
        WHEN 29 THEN '수리불가' WHEN 30 THEN '출고' WHEN 40 THEN '현장수리' WHEN 41 THEN '외주위탁수리'
        ELSE wc.WORK_CODE END) AS WORK_CODE")
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->where("me.EMP_CODE", $empCode)
        ->orderBy('fc.IDX', 'asc')
        ->get();

        $response = array('response' => ["message"=> "회수출고 현황 검색", "data"=> $recallAfterRelease], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 16 중고품 회수현황
    public function recallStat(Request $request) {
        $wholeName = $request->wholeName ?? '';
        $empGroup =  Session::get('empGroup');
        if($empGroup == "C") { // 냉동회사의 경우
            $empCode = '';
        } else { // 수리기사의 경우
            $empCode = Session::get('empCode');
        }

        $recallStat  = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_NAME","ms.STORE_ADDRESS","ms.STORE_PHONE","mg.GOODS_MODEL_YEAR"
        ,"wc.WORK_CODE","wc.WORK_MANAGE","wc.WORK_TXT","fc.FIX_NAME","fc.SALES_COST","mg.GOODS_NAME" )
        ->selectRaw("(CASE wc.WORK_CODE 
        WHEN 00 THEN '판매' WHEN 10 THEN '입고' WHEN 20 THEN '수리대기' WHEN 21 THEN '수리완료' WHEN 90 THEN '폐기'
        WHEN 29 THEN '수리불가' WHEN 30 THEN '출고' WHEN 40 THEN '현장수리' WHEN 41 THEN '외주위탁수리'
        ELSE wc.WORK_CODE END) AS WORK_CODE")
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->where("me.EMP_CODE", $empCode)
        ->orderBy('fc.IDX', 'asc')
        ->get();

        $response = array('response' => ["message"=> "회수출고 현황 검색", "data"=> $recallStat], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 18 매출처별 집계현황
    public function aggregateByWhole(Request $request) {

        $wholeName = $request->wholeName ?? '';
        $aggregateByWhole  = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->selectRaw("count(fc.IDX) 건수, sum(fc.SALES_COST*0.9) 공급가
        ,sum(fc.SALES_COST*0.1) 부가세 ,sum(fc.SALES_COST) 합계")
        ->selectRaw("(CASE wc.WORK_CODE 
        WHEN 00 THEN '판매' WHEN 10 THEN '입고' WHEN 20 THEN '수리대기' WHEN 21 THEN '수리완료' WHEN 90 THEN '폐기'
        WHEN 29 THEN '수리불가' WHEN 30 THEN '출고' WHEN 40 THEN '현장수리' WHEN 41 THEN '외주위탁수리'
        ELSE '합계' END) AS WORK_CODE")
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->groupByRaw('wc.WORK_CODE WITH ROLLUP')
        ->get();
        $response = array('response' => ["message"=> "매출처별 집계현황 검색", "data"=> $aggregateByWhole], 'success'=> true);
        return Response::json($response, 200);
    }

    // ppt 19 A/S 현황
    public function aftetServiceStat(Request $request) {
        $wholeName = $request->wholeName ?? '';
        $empGroup =  Session::get('empGroup');
        if($empGroup == "C") { // 냉동회사의 경우
            $empCode = '';
        } else { // 수리기사의 경우
            $empCode = Session::get('empCode');
        }

        $aftetServiceStat  = DB::table('T_FIX_COST','fc')
        ->join('T_WORK_COMPLETE AS wc', 'wc.FIX_COST_IDX','=','fc.FIX_COST_IDX')
        ->join('T_MASTER_ICE AS mi', 'wc.ICE_CODE', '=', 'mi.ICE_CODE')
        ->join('T_MASTER_WHOLESALE as mw', 'wc.WHOLE_CODE', '=', 'mw.WHOLE_CODE')
        ->join('T_MASTER_STORE as ms', 'wc.STORE_CODE', '=', 'ms.STORE_CODE')
        ->join('T_MASTER_GOODS as mg', 'wc.GOODS_CODE', '=', 'mg.GOODS_CODE')
        ->join('T_MASTER_EMP as me', 'wc.EMP_CODE', '=', 'me.EMP_CODE')
        ->select("fc.REG_DATE","ms.STORE_NAME","ms.STORE_PHONE","mg.GOODS_MODEL_YEAR"
        ,"wc.WORK_CODE","wc.WORK_MANAGE","wc.WORK_TXT","fc.FIX_NAME","fc.SALES_COST","mg.GOODS_NAME" )
        ->whereBetween("fc.REG_DATE",[request('startDate'),request('endDate')])
        ->where("mw.WHOLE_NAME",'like',"%{$wholeName}%")
        ->where("me.EMP_CODE", $empCode)
        ->get();

        $response = array('response' => ["message"=> "회수출고 현황 검색", "data"=> $aftetServiceStat], 'success'=> true);
        return Response::json($response, 200);
    }

   
}
