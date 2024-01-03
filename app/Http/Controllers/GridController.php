<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;

class GridController extends Controller
{
    public function toastuigrid() {
        return view('authen.grid');
    }
    public function gridData() {

        $data = [
            [
                "name"=>"Beautiful Lies 1",
                "artist"=>"Birdy 1" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ],
            [
                "name"=>"Beautiful Lies 2",
                "artist"=>"Birdy 2" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ],
            [
                "name"=>"Beautiful Lies 33",
                "artist"=>"Birdy 3" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ],
        ];
        //dd(response()->json(['contents' => $data])); 
        return response()->json([
            "result" => true, 
            "data" => ["contents" => $data] ,
            "pagination" => ["page" => 1, "totalCount"=> 100 ],
        ]); 

    }

    public function jqgrid() {
        return view('authen.jqgrid');
    }

    public function jqgriddata() {
        $data = DB::table('test')
        ->selectRaw("NAME_T,ARTIST_T,RELEASE_T,GENRE_T")
        ->get();
        return response()->json(["rows" => $data]); 
        /** 반환 타입
         * {"page":"1",
         * " total:10,
         * "records":"1",
         * "rows":[{"id":"1",null]},
         * {"id":"2",null]},
         * {"id":"3","no"]}],
         * "userdata":{"username":1,"user_id":1}}
         */
    }

    public function officialgrid() {
        return view('authen.officialgrid');
    }
    public function buttonData() {
        $data = DB::table('test')
        ->selectRaw("NAME_T,ARTIST_T,RELEASE_T,GENRE_T")
        ->get();
        echo json_encode($data);
        //return Response::json($data);
    }
}
