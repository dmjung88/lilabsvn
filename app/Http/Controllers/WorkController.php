<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    // 19 접수 저장
    public function receiveSave(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'iceCode'  => 'required',
            'workDate'  => 'required|date', //'2020-01-01 00:00:00'
            'reqDate'   => 'required|date',
            'workType'  => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9\s]+/|max:30',
            'workTitle' => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9\s]+/|max:30',
        ]);
        $response = array('response' => '', 'success'=> false);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('T_WORK_REQUEST')->insert([
                'ICE_CODE' => $request->input('iceCode'),
                'WORK_DATE' => $request->input('workDate'),
                'REQ_DATE' => $request->input('reqDate'),
                'WORK_TYPE' => $request->input('workType'),
                'WORK_TITLE' => $request->input('workTitle'),
                'REG_DATE'  => now(),
                'STORE_CODE' => 'S0001',
                'WHOLE_CODE' => 'W0001',
            ]);
            $response['response'] = ["message"=> "업무접수 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }

    //20 업무코드별 데이터 조회
    public function codeSearch(Request $request) {
        $sql = "SELECT * FROM `t_work_request` WHERE store_code LIKE ? OR idx = ? ";
        $reqSearch = DB::selectOne($sql ,["%{$request->storeCode}%",$request->id]);
        $response = array('response' => ["message"=> "업무접수아이디 또는 업소코드로 검색", "data"=> $reqSearch], 'success'=> true);
        return Response::json($response, 200);
    }
    //21 매출내용 등록
    public function salesSave (Request $request) {
        $validator = Validator::make($request->all(), [ 
            ''  => 'required',
            ''  => 'required|date', //'2020-01-01 00:00:00'
            ''  => 'required|regex:/^[ㄱ-ㅎ가-힣a-zA-Z0-9\s]+/|max:30',
        ]);
        $response = array('response' => '', 'success'=> false);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('')->insert([
               
            ]);
            $response['response'] = ["message"=> "매출내용 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }

    //22 해당업무 저장
    public function workProSave(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'iceCode'  => 'required',
            'storeCode' => 'required',
            'storeName' => '업소명',
            'wholeCode' => 'required',
            'workDate'  => 'required|date', //'2020-01-01 00:00:00'
            'empCode' => 'required',
            'empName' => 'required',
            'workCode'  => 'required',
            'goodsCode'  => 'required',
            'goodsName'  => 'required',
            'fixCostIdx' => 'required',
        ]);
        $response = array('response' => '', 'success'=> false);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('T_WORK_COMPLETE')->insert([
                'ICE_CODE' => $request->input('iceCode'),
                'STORE_CODE' => $request->input('storeCode'),
                'STORE_NAME' => '업소명',
                'WHOLE_CODE' => $request->input('wholeCode'),
                'WORK_DATE' => $request->input('workDate'),
                'EMP_CODE' => $request->input('empCode'),
                'EMP_NAME' => '사원명',
                'WORK_CODE' => $request->input('workCode'),
                'GOODS_CODE' => $request->input('goodsCode'),
                'GOODS_NAME' => '상품명',
                'WORK_MANAGE' => $request->input('workManage'),
                'WORK_TXT' => $request->input('workTxt'),
                'FIX_COST_IDX' => '1',
                'REG_DATE' => now(),
            ]);
            $response['response'] = ["message"=> "해당업무 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
    //23 업소수정 (항목별) 업무처리 수정모드
    public function workModify(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'id' => 'required',
            'storeCode' => 'required',
            'wholeCode' => 'required',
            'workDate'  => 'required|date', //'2020-01-01 00:00:00'
            'empCode' => 'required',
            'workCode'  => 'required',
            'goodsCode'  => 'required',
            'goodsName'  => 'required',
            'fixCostIdx' => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('T_WORK_COMPLETE')->where('IDX', $request->id)->update([
                'STORE_CODE' => $request->get('storeCode'),
                'WORK_DATE' => $request->get('workDate'),
                'WORK_MANAGE' => $request->get('workManage'),
                'WORK_TXT' => $request->get('workTxt'),
            ]);
            $response['response'] = ["message"=> "업무처리 수정모드 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
}
