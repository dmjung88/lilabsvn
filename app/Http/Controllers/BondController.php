<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BondController extends Controller
{

    public function delete($id) {
        DB::table('테이블')->where('idx', $id)->delete();
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
