<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
         {{-- 유효성 에러 --}}
    @if($errors->any())
         @foreach ($errors->all() as $error )
             {{ $error }}
         @endforeach
     @endif

     {{-- with('success','성공') --}}
     @if(session()->has('success'))
         {{ session('success') }}
     @endif

    <form action="{{ route('personalLogin') }}" method="get">
        <fieldset>
            <legend>수리기사님 로그인</legend>
            소속사업자 : <input type="text" name="iceCode"><br>
            전화번호 : <input type="text" name="empPhone"><br>
            비밀번호 : <input type="password" name="password"><br>
            <button type="submit">수리기사 로그인</button>
        </fieldset>
    </form>
    <form action="{{ route('companyLogin') }}" method="get">
        <fieldset>
            <legend>회사관리자 로그인</legend>
            사업자번호 : <input type="text" name="iceBizNum"><br>
            비밀번호 : <input type="password" name="password"><br>
            <button type="submit">회사 관리자 로그인</button>
        </fieldset>
    </form>
     
    </body>
</html>
