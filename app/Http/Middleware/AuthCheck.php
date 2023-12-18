<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * 미들웨어-Kernel.php 등록
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('LoggedUserId') && ($request->path() !='auth/login' && $request->path() !='auth/register' )){
            //로그인 X 이거나 로그인 또는 회원가입 페이지가아니면
            return redirect('auth/login')->with('fail','로그인해야 페이지를 이용할수있습니다.');
            //로그인 페이지로 리디렉트       
        }
        if(session()->has('LoggedUserId') && ($request->path() == 'auth/login' || $request->path() == 'auth/register' ) ) {
            //로그인 중이면서 로그인 페이지 또는 회원가입 페이지로 이동하면
            return back();
        }
        //if(url('login') == $request->url() || url('register') == $request->url())
        //FORWARD
        return $next($request);
    }
}
