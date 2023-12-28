<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = [
            [
                "name"=>"JQ 1",
                "artist"=>"JQ 1" ,
                "release"=>"2016.03.26",
                "genre"=>""
            ],
            [
                "name"=>"JQ 2",
                "artist"=>"JQ 2" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ],
            [
                "name"=>"JQ 33",
                "artist"=>"JQ 3" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ],
            [
                "name"=>"JQ 4",
                "artist"=>"JQ 4" ,
                "release"=>"2016.03.26",
                "genre"=>"Rock"
            ],
            [
                "name"=>"JQ 5",
                "artist"=>"JQ 5" ,
                "release"=>"2016.03.26",
                "genre"=>"Hiphop"
            ],
            [
                "name"=>"JQ 6",
                "artist"=>"JQ 6" ,
                "release"=>"2016.03.26",
                "genre"=>"Pop"
            ]
        ];
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
}
