<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class EmpLoginController extends Controller
{
    public function getLogin(){
        // $credentials = $request->only('id','password') :array
        // if(Auth::attempt($credentials))
        // return redirect()->intended(route(''));

        return view('emp.login');
    }

    public function personalLogin(Request $request){
        $request->validate([
            'iceCode'=>'required|email',
            'empPhone'=>'required|email',
            'password'=>'required|min:3|max:12'
        ]);
        $iceCode = str_replace('-', '', $request->iceCode);
        $empPhone = str_replace('-', '', $request->empPhone);
        $userInfo = DB::table('T_MASTER_ICE AS mi')
        ->join('T_MASTER_EMP AS me', 'mi.ICE_CODE','=','me.ICE_CODE')->where([
            ['EMP_GROUP', '=', 'E'],
            ['EMP_PHONE', '=', $empPhone],
            ['me.ICE_CODE', '=',  $iceCode],
        ])->first();

        if(!$userInfo){
            return back()->with('fail','이메일이 등록되지 않았습니다.');
        } else {
            //if(Hash::check($request->password, $userInfo->EMP_PASSWORD)){
            if($request->password == $userInfo->EMP_PASSWORD){
                $request->session()->put('iceCode', $userInfo->ICE_CODE);
                Session::put('empGroup', $userInfo->EMP_GROUP); 
                Session::put('empCode', $userInfo->EMP_CODE); 
                Session::put('empName', $userInfo->EMP_NAME); 
                Session::put('empType', $userInfo->EMP_TYPE); 
                dd(Session::all());
                return redirect('admin/dashboard');
            } else {
                return back()->with('fail','비밀번호 불일치.');
            }
        }
    }

    public function companyLogin(Request $request){
        $request->validate([
            'iceBizNum'=>'required|email',
            'password'=>'required|min:3|max:12'
        ]);
        $bizNum = str_replace('-', '', $request->iceBizNum);
        $userInfo = DB::table('T_MASTER_ICE AS mi')
        ->join('T_MASTER_EMP AS me', 'mi.ICE_CODE','=','me.ICE_CODE')->where([
            ['EMP_GROUP', '=', 'C'],
            ['ICE_BIZNUM', '=',  $bizNum],
        ])->first();
  
        if(!$userInfo){
            return back()->with('fail','사업자번호가 존재하지 않습니다.');
        } else {
            //if(Hash::check($request->password, $userInfo->EMP_PASSWORD)){
            if($request->password == $userInfo->EMP_PASSWORD){
                $request->session()->put('iceCode', $userInfo->ICE_CODE);
                Session::put('iceConame', $userInfo->ICE_CONAME);
                Session::put('empGroup', $userInfo->EMP_GROUP); 
                dd(Session::all());
                return redirect('admin/dashboard');
            } else {
                return back()->with('fail','비밀번호 불일치.');
            }
        }
    }
    public function dashboard() {
        if(Session::has('LoggedUserId')) {
            $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUserId'))->first()];
            return view('emp.dashboard', $data);
        }
    }

    public function logout() {
        if(session()->has('LoggedUserId')){
            session()->pull('LoggedUserId');
            //Session::forget('LoggedUserName');
            Session::flush();
            //Auth::logout();
            return redirect('/emp/login');
        }
    }
}
