<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Master;

class MasterController extends Controller
{

    public function __construct() {
        // $this->middleware('guest', [ 'except' => 'logout', ]);
    }  

    public function getTest() {
        $result = request('result');
        if($result) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors() 
            ]);
        } else {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()
            ]);
        }
    }

    public function wholesaleSave(Request $request) { // 도매장 저장
        $validator = Validator::make($request->all(), [ // Form_validation
            'wholeName'  => 'required|max:30|string',
            'wholePhone' => 'required|max:11|regex:/^[가-힣\s]+/|',
            'wholeCeo'  => 'required|max:10',
            'wholeBiz'   => 'required|max:10',
            'wholeBizNum' => 'required',
            'wholeType'  => 'required',
            'wholeAddress' => 'required',
            'wholeZipcode' => 'required',
            'wholeEmail' => 'required',
            'wholeUseYN' => 'required',
            'note'       => 'required',
            'add1'       => 'required',
        ]);
        $response = array('response' => '', 'success'=> false);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_WHOLESALE')->insert([
                'ICE_CODE' => $request->input('iceCode'),
                'WHOLE_CODE' => "W" . Master::wCodeSeq(),
                'WHOLE_NAME' => $request->input('wholeName'),
                'WHOLE_PHONE' => $request->input('wholePhone'),
                'WHOLE_CEO' => $request->input('wholeCeo'),
                'WHOLE_BIZ' => $request->input('wholeBiz'),
                'WHOLE_BIZ_NUM' => $request->input('wholeBizNum'),
                'WHOLE_TYPE' => $request->input('wholeType'),
                'WHOLE_ADDRESS' => $request->input('wholeAddress'),
                'WHOLE_ZIPCODE' => $request->input('wholeZipcode'),
                'WHOLE_EMAIL' => $request->input('wholeEmail'),
                'WHOLE_USEYN' => $request->input('wholeUseYN'),
                'NOTE' => $request->input('note'),
                'ADD1' => $request->input('add1'),
            ]);
            $response['response'] = ["message"=> "도매장저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
    public function storeSave(Request $request) { // 업소 저장
        $rules = [
            'iceCode'=>'required|numeric|max:10|min:1',
            'storeName'=>'required',
            'wholeCode'=>'required',
            'storePhone'=>'required',
            'storeCeo' =>'required', 
            'storeBizNum'=>'required', 
            'storeBiz'=>'required', 
            'storeType'=>'required',
            'empCode' => 'required',
            'storeAddress' =>'required',
            'storeZipcode' =>'required',
            'storeEmail' =>'required',
            'storeUseYN' =>'required',
            'note' =>'required',
            'regId' =>'required',
        ];
        $response = array('response' => '', 'success'=> false);
        $validator = Validator::make($request->all(), $rules); // Form_validation
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_STORE')->insert([
                'ICE_CODE' => $request->get('iceCode'),
                'STORE_CODE' => "M" . Master::sCodeSeq(),
                'STORE_NAME' => $request->get('storeName'),
                'WHOLE_CODE' => $request->get('wholeCode'),
                'STORE_PHONE' => $request->get('storePhone'),
                'STORE_CEO' => $request->get('storeCeo'),
                'STORE_BIZ_NUM' => $request->get('storeBizNum'),
                'STORE_BIZ' => $request->get('storeBiz'),
                'STORE_TYPE' => $request->get('storeType'),
                'EMP_CODE' => $request->get('empCode'),
                'STORE_ADDRESS' => $request->get('storeAddress'),
                'STORE_ZIPCODE' => $request->get('storeZipcode'),
                'STORE_EMAIL' => $request->get('storeEmail'),
                'STORE_USEYN' => $request->get('storeUseYN'),
                'NOTE' => $request->get('note'),
                'REG_ID' => $request->get('regId'),
            ]);
            $response['response'] = ["message"=> "업소저장 성공"];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
    public function goodsSave(Request $request) { //상품 저장
        $validator = Validator::make($request->all(), [ // Form_validation
            'iceCode' => 'required|numeric|max:10|min:1',
            'goodsCode'  => 'required',
            'goodsName'  => 'required',
            'wholeCode'  => 'required',
            'goodsMaker' => 'required',
            'goodsDiv'   => 'required',
            'goodsNick'  => 'required',
            'goodsVol'   => 'required',
            'goodsType'  => 'required',
            'lastModify' => 'required',
            'purchCost'  => 'required',
            'goodsUseYN' => 'required',
            'note'       => 'required',
            'regId'      => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_GOODS')->insert([
                'ICE_CODE' => $request->input('iceCode'),
                'GOODS_CODE' => "G" . Master::gCodeSeq(),
                'GOODS_NAME' => $request->input('goodsName'),
                'WHOLE_CODE' => $request->input('wholeCode'),
                'GOODS_MAKER' => $request->input('goodsMaker'),
                'GOODS_DIV' => $request->input('goodsDiv'),
                'GOODS_NICK' => $request->input('goodsNick'),
                'GOODS_VOL' => $request->input('goodsVol'),
                'GOODS_TYPE' => $request->input('goodsType'),
                'PURCH_COST' => $request->input('purchCost'),
                'GOODS_USEYN' => $request->input('goodsUseYN'),
                'NOTE'   => $request->note,
                'REG_ID' => $request->regId,
                'LAST_MODIFY' => now(),
                'UP_DATE'     => date('Y-m-d H:i:s'),

            ]);
            $response['response'] = ["message"=> "상품 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
    public function fixSave(Request $request) { //수리정보 저장
        $validator = Validator::make($request->all(), [ // Form_validation
            'iceCode' => 'required|numeric|max:10|min:1',
            'fixCode'  => 'required',
            'fixName'  => 'required',
            'purchCost' => 'required',
            'salesCost' => 'required',
            'marginPer'  => 'required',
            'note'       => 'required',
            'regId'      => 'required',
            'fixUseYN'   => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_FIX')->insert([
                'ICE_CODE' => $request->input('iceCode'),
                'FIX_CODE' => "F" . Master::fCodeSeq(),
                'FIX_NAME' => $request->input('fixName'),
                'PURCH_COST' => $request->input('purchCost'),
                'SALES_COST' => $request->input('salesCost'),
                'MARGIN_PER' => $request->input('marginPer'),
                'NOTE' => $request->input('note'),
                'LAST_MODIFY' => $request->input('regId'),
                'ADD1' => $request->input('fixUseYN'),
                'UP_DATE'     => date('Y-m-d H:i:s'),
                'REG_ID' => $request->regI

            ]);
            $response['response'] = ["message"=> "수리정보 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }

    public function employeeSave(Request $request) { //수리기사(영업) 사원 저장
        $validator = Validator::make($request->all(), [ // Form_validation
            'iceCode' => 'required|numeric|max:10|min:1',
            'empCode'  => 'required',
            'empName'  => 'required',
            'empPhone' => 'required',
            'empPassword' => 'required',
            'empType'  => 'required',
            'note'       => 'required',
            'regId'      => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_EMP')->insert([
                'ICE_CODE' => 'C0001',
                'EMP_CODE' => "E" . Master::eCodeSeq(),
                'EMP_NAME' => $request->input('empName'),
                'EMP_PHONE' => $request->input('empPhone'),
                'EMP_PASSWORD' => $request->input('empPassword'),
                'EMP_TYPE' => $request->input('empType'),
                'NOTE' => $request->input('note'),
                'ADD1' => $request->input('add1'),
                'UP_DATE' => date('Y-m-d H:i:s'),
                'REG_ID'  => $request->regId,
            ]);
            $response['response'] = ["message"=> "수리기사 저장 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
    // 도매장 update MODE
    public function wholeSaleUpdate(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'wholeCode' => 'required',

            'wholeName'  => 'required|max:30|regex:/^[가-힣\s]+/|',
            'wholePhone' => 'required|max:11',
            'wholeCeo'  => 'required|max:10',
            'wholeBiz'   => 'required|max:10',
            'wholeBizNum' => 'required',
            'wholeType'  => 'required',
            'wholeAddress' => 'required',
            'wholeZipcode' => 'required',
            'wholeEmail' => 'required',
            'wholeUseYN' => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_WHOLESALE')->where('WHOLE_CODE', $request->wholeCode)->update([
                'WHOLE_NAME' => $request->input('wholeName'),
                'WHOLE_PHONE' => $request->input('wholePhone'),
                'WHOLE_CEO' => $request->input('wholeCeo'),
                'WHOLE_BIZ' => $request->input('wholeBiz'),
                'WHOLE_BIZ_NUM' => $request->input('wholeBizNum'),
                'WHOLE_TYPE' => $request->input('wholeType'),
                'WHOLE_ADDRESS' => $request->input('wholeAddress'),
                'WHOLE_ZIPCODE' => $request->input('wholeZipcode'),
                'WHOLE_EMAIL' => $request->input('wholeEmail'),
                'WHOLE_USEYN' => $request->input('wholeUseYN'),
                'NOTE' => $request->input('note'),
                'ADD1' => $request->input('add1'),
            ]);
            $response['response'] = ["message"=> "도매장 수정 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }

    // 업소 update MODE
    public function storeUpdate(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'storeName'=>'required',
            'wholeCode'=>'required',
            'storePhone'=>'required',
            'storeCeo' =>'required', 
            'storeBizNum'=>'required', 
            'storeBiz'=>'required', 
            'storeType'=>'required',
            'empCode' => 'required',
            'storeAddress' =>'required',
            'storeZipcode' =>'required',
            'storeEmail' =>'required',
            'storeUseYN' =>'required',
            'note' =>'required',
            'regId' =>'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_STORE')->where('STORE_CODE', $request->storeCode)->update([
                'ICE_CODE' => $request->get('iceCode'),
                'STORE_CODE' => "M" . Master::sCodeSeq(),
                'STORE_NAME' => $request->get('storeName'),
                'WHOLE_CODE' => $request->get('wholeCode'),
                'STORE_PHONE' => $request->get('storePhone'),
                'STORE_CEO' => $request->get('storeCeo'),
                'STORE_BIZ_NUM' => $request->get('storeBizNum'),
                'STORE_BIZ' => $request->get('storeBiz'),
                'STORE_TYPE' => $request->get('storeType'),
                'EMP_CODE' => $request->get('empCode'),
                'STORE_ADDRESS' => $request->get('storeAddress'),
                'STORE_ZIPCODE' => $request->get('storeZipcode'),
                'STORE_EMAIL' => $request->get('storeEmail'),
                'STORE_USEYN' => $request->get('storeUseYN'),
                'NOTE' => $request->get('note'),
                'REG_ID' => $request->get('regId'),
            ]);
            $response['response'] = ["message"=> "업소 수정 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
        
    }

    // 상품 update MODE
    public function goodsUpdate(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'goodsName'  => 'required',
            'wholeCode'  => 'required',
            'goodsMaker' => 'required',
            'goodsDiv'   => 'required',
            'goodsNick'  => 'required',
            'goodsVol'   => 'required',
            'goodsType'  => 'required',
            'lastModify' => 'required',
            'purchCost'  => 'required',
            'goodsUseYN' => 'required',
            'note'       => 'required',
            'regId'      => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_GOODS')->where('GOODS_CODE', $request->goodsCode)->update([
                'GOODS_NAME' => $request->input('goodsName'),
                'WHOLE_CODE' => $request->input('wholeCode'),
                'GOODS_MAKER' => $request->input('goodsMaker'),
                'GOODS_DIV' => $request->input('goodsDiv'),
                'GOODS_NICK' => $request->input('goodsNick'),
                'GOODS_VOL' => $request->input('goodsVol'),
                'GOODS_TYPE' => $request->input('goodsType'),
                'PURCH_COST' => $request->input('purchCost'),
                'GOODS_USEYN' => $request->input('goodsUseYN'),
                'NOTE'   => $request->note,
                'REG_ID' => $request->regId,
                'LAST_MODIFY' => now(),
                'UP_DATE'     => date('Y-m-d H:i:s'),
            ]);
            $response['response'] = ["message"=> "상품 수정 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
 
    // 수리정보 update MODE
    public function fixUpdate(Request $request) {
        $validator = Validator::make($request->all(), [ // Form_validation
            'fixName'  => 'required',
            'purchCost' => 'required',
            'salesCost' => 'required',
            'marginPer'  => 'required',
            'note'       => 'required',
            'regId'      => 'required',
            'fixUseYN'   => 'required',
        ]);
        $response = ['response' => '', 'success'=> false];
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            DB::table('MASTER_FIX')->where('FIX_CODE', $request->fixCode)->update([
                'PURCH_COST' => $request->input('purchCost'),
                'SALES_COST' => $request->input('salesCost'),
                'MARGIN_PER' => $request->input('marginPer'),
                'NOTE' => $request->input('note'),
                'LAST_MODIFY' => $request->input('regId'),
                'ADD1' => $request->input('fixUseYN'),
                'UP_DATE'     => date('Y-m-d H:i:s'),
                'REG_ID' => $request->regI
            ]);
            $response['response'] = ["message"=> "수리정보 수정 성공" ];
            $response['success'] = true;
        }
        return Response::json($response, 201);
    }
}
