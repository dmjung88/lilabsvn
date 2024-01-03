<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function example() {
        //$post = DB::select("select * from `board` limit 0, 10");

        //$post = DB::table('board')->where('uid', $id)->get();
        //$post = DB::table('board')->whereRaw('uid=?', [$id])->first();
        //$post = DB::table('board')->whereRaw('uid= :id', ['id' => $id])->get();
        //$post = DB::selectOne("select * from `board` WHERE uid = ?", [$id]);
        //$post = DB::selectOne("select * from BOARD WHERE uid = :id", ['id' => $id]);

        // DB::enableQueryLog();
        // $result = DB::select('select * from users where user_id = :id', ['id' => $id]);
        // dd(DB::getQueryLog());
        // DB::table('users')->toSql();
        // dd($request->input());

        // DB::enableQueryLog();
        // $queries = DB::getQueryLog();
        // $lastQuery = end($queries);
        // var_dump($lastQuery); die();

        // Customer::select('customers.*')
        // ->leftJoin('orders', 'customers.id', '=', 'orders.customer_id')
        // ->whereNull('orders.customer_id')
        // Customer::doesntHave('orders')
        // User::query()->join('테이블B AS 별칭', '테이블A.ID','=','테이블B.ID','left outer')
    }
    public function delete($id) {
        DB::table('테이블')->where('idx', $id)->delete();
        //SELECT IFNULL(컬럼,"null 대체문자") as 컬럼별칭, 
        //SELECT COALESCE(컬럼,"null 대체문자") as 컬럼별칭, 
        //https://employee.tistory.com/entry/Laravel-public-folder를-publichtml로-변경
        //라라벨 배포 - url에 public없애는 방법 
        // redirect()->route()
    }
    public function modelCustomMethod() {
        $model = new User(); //() 없어야함
        die($model->custom);
    }
}
