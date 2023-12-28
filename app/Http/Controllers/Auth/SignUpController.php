<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;
class SignUpController extends Controller
{
    public function getLogin(){
        // $credentials = $request->only('email','password') :array
        // if(Auth::attempt($credentials))
        // return redirect()->intended(route(''));

        return view('authen.login');
    }

    public function getRegister(){
        return view('authen.register');
    }
    public function postRegister(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3|max:12'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $result = $user->save();

        if($result){
            return back()->with('success','회원가입 성공');
        } else {
            return back()->with('fail','문제가 발생했습니다. 나중에 다시 시도하십시오');
        }
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:3|max:12'
        ]);
        $userInfo = User::where('email','=', $request->email)->first();
        if(!$userInfo){
            return back()->with('fail','이메일이 등록되지 않았습니다.');
        } else {
            if(Hash::check($request->password, $userInfo->password)){
                //세션넣기
                $request->session()->put('LoggedUserId', $userInfo->id);
                //Session:push('LoggedUserName', $userInfo->name);
                
                return redirect('admin/dashboard');
            } else {
                return back()->with('fail','비밀번호 불일치.');
            }
        }
    }
    public function dashboard() {
        if(Session::has('LoggedUserId')) {
            $data = ['LoggedUserInfo'=>User::where('id','=', session('LoggedUserId'))->first()];
            return view('authen.dashboard', $data);
        }
    }

    public function logout() {
        if(session()->has('LoggedUserId')){
            session()->pull('LoggedUserId');
            //Session::forget('LoggedUserName');
            Session::flush();
            //Auth::logout();
            //throw new Exception("예외내용.");
            return redirect('/auth/login');
        }
    }
}
