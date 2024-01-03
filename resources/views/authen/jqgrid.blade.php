<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JQ그리드</title>
  {{-- JQ 그리드 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/css/ui.jqgrid.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/jquery.jqgrid.min.js"></script>

{{-- 
    url : 데이터 API 요청을 보낼 주소를 입력
    mtype : API 요청 방식을 설정(get || post)
    datatype : 가지고 오는 데이터의 타입을 설정한다. 보통 xml, json,local 이렇게 세 가지를 자주 사용.
    colNames : 그리드 각각의 컬럼에 출력되는 이름이고, 배열로 설정한다.
    colModel : 각 컬럼에 대한 상세 정보이다. 서버로부터 받아온 데이터를 매핑해서 출력한다.  
    jsonReader/xmlReader : 데이터 타입이 json/xml일 경우 reader를 통해서 데이터를 어떻게 읽어들일지 설정.
    rowNum : 초기에 출력할 데이터의 개수를 설정.
    pager : jqGrid <Table> 하위에 <div> 를 넣어주고 그 div의 id값을 써주면 된다
    multiselect : row마다 selectbox가 생긴다(이벤트 처리 가능)
    postData : 서버에 파라미터로 넘길 데이터를 설정한다. 배열의 형태로 설정 가능하고,  serialize() 가능.
    loadComplete : 서버에 모든 요청 후 즉시 발생
    onCellSelect : 그리드의 특정 셀을 클릭시 발생
    ondblClickRow : row가 더블클릭한 직후 발생
    autowidth: true,    // jQgrid width 자동100% 채워지게
    shrinkToFit: false,  // width를 자동설정 해주는 기능
--}}
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    .ui-jqgrid.ui-jqgrid-bootstrap {
        border: 1px solid #003380;
    }
    .ui-jqgrid.ui-jqgrid-bootstrap .ui-jqgrid-caption {
        background-color: #e6f0ff;
    }
    .ui-jqgrid.ui-jqgrid-bootstrap .ui-jqgrid-hdiv {
        background-color: #cce0ff;
    }
    .ui-search-input > input::-ms-clear {
        display: none;
    }

</style>
</head>
<body>
    <div class="tableWrap">
        <table id="mainGrid"></table>
        <div id="gridPager"></div>    
    </div>
    <button type="button">버튼</button>
    <div class="tableWrap2">
        <table id="mainGrid2"></table>
        <div id="gridPager2"></div>    
    </div>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var searchResultColNames =  ['이름', '아티스트', '발매', '장르'];
    var searchResultColModel =  [  
        {name:'NAME_T',   index:'NAME_T',   align:'center', hidden:true},
        {name:'ARTIST_T', index:'ARTIST_T', align:'left',   width:'24%'},
        {name:"RELEASE_T",label:"Date",   align:"center", width:'50%', sortType: "date", formatter: "date", formatoptions: { newformat: "Y-m-d" } },
        {name:"GENRE_T", width:'26%', align: "center", formatter: "select", formatoptions: { value: "Pop:팝;Hiphop:힙합;Rock:락", defaultValue: "Rock"}}
    ];

    $(document).ready(function(){
        "use strict";
        $("#mainGrid").jqGrid({
            url:" {{ route('jqgriddata')}}",
            dataType:"json",
            mtype: "get",
            colNames : searchResultColNames,
            colModel : searchResultColModel,
            rowNum : 2,
            rowList:[5,10,15],
            pager: "#gridPager",
            height: 261,
            width: 1019,
            guiStyle: "bootstrap4", //부트스트랩사용
            iconSet: "fontAwesome", //폰트어썸 사용
            idPrefix: "gb1_",
            rownumbers: true, //번호가 포함된 추가 열을 생성 
            sortname: "RELEASE_T", //최신 날짜가 먼저 표시된
            sortorder: "desc",
            threeStateSort: true,
            sortIconsBeforeText: true,
            headertitles: true,
            toppager: true,
            pager: true,
            viewrecords: true,
            loadonce: true, //필수 데이터 필수한번가져오기
            searching: {
                defaultSearch: "cn" //contain 포함 연산자
            },
            // loadComplete :function(data) { //로딩후
            //     console.log("로딩끝")
            // },
            // onSelectRow : function(id) { //행 클릭시
            //     console.log(id)
            // },
            // ondblClickRow :function(rowid, status, e) { //행 더블클릭시
            //     console.log("더블클릭")
            // },
            caption: "그리드"
        }); //endGRID
        $("#mainGrid").jqGrid('navGrid',"#gridPager",{ edit:false,add:false,del:false });

        //ajax 데이터 불러오기
        $("button").click(function() {
            $.ajax({
                url :"{{ url('front/buttonData')}}",
                method:"GET",
                dataType: "JSON",
                data :{},
                contentType : "application/json; charset=UTF-8",
                success:function(result) {
                    //var result = $.parseJSON(result);
                    console.dir(result);
                    $("#mainGrid2").jqGrid({
                        dataType:"local",
                        colNames : searchResultColNames,
                        colModel : searchResultColModel,
                        data :result,
                        rowNum : 3,
                        rowList:[5,10,15],
                        pager: "#gridPager2",
                        height: "auto",
                        guiStyle: "bootstrap4", //부트스트랩사용
                        iconSet: "fontAwesome", //폰트어썸 사용
                        idPrefix: "gb1_",
                        rownumbers: true, //번호가 포함된 추가 열을 생성 
                        sortname: "RELEASE_T", //최신 날짜가 먼저 표시된
                        sortorder: "desc",
                        threeStateSort: true,
                        sortIconsBeforeText: true,
                        headertitles: true,
                        toppager: true,
                        pager: true,
                        viewrecords: true,
                        loadonce: true, //필수 데이터 필수한번가져오기
                        gridView :true,
                        autowidth: true,
                        altRows :true,
                        hoverRows: true,
                        caption: "가수명"

                    });
                    $("#mainGrid2").jqGrid('navGrid',"#gridPager2",{ edit:false,add:false,del:false });
                },
                error:function(err) {
                    console.log(err)
                }
            })
        });
    }); //endJQ
    /*  var postData = objConvertJson($("form")); //form 데이터 json으로 변경
    var formData = $('#FORM1').serialize();
    {name:'서버로 넘어오는 ',   index:'정렬시 서버로 넘어가는', align:'데이터정렬'},\
    name : 'response 받아올 변수의 이름',
    index : 'jqGird안에서 접근할 이름',미지정시 name
    -key : 유일한 rowId값을 위해 id를 지정할 수 있습니다. 반드시 하나의 컬럼에만 지정해야하고, 유일한 값
    -label : colNames 가 비어있을 때 컬럼의 제목을 정의한다. (단. colName 배열과 label 속성이 없을 경우 name으로 대체한다.)

    */
    
    /*
        https://free-jqgrid.github.io/getting-started/index.html#bootstrap_code
        url : ajax 처럼 데이터를 주고받을 서버 url 주소이다.
        datatype : 말 그대로 데이터의 타입이다. ajax처럼 사용하면 된다. (local 타입도 존재)
        postData : 넘겨줄 데이터이다.
        mtype : POST or GET
        colNames : 그리드 헤더의 제목 배열이며 ( colModel 과 개수가 꼭 맞아야한다. )
        colModel : 그리드 행에 보여줄 데이터로 꼭 데이터 컬럼,colNames 과 매칭을 시켜줘야 한다. 
        rowNum : 보여줄 행의 개수
        pager : 페이징을 하기 위해 선언해두며 거의 필수라 보면 된다.
        height , width : 높이 , 넓이
        caption : 타이틀 , 제목
    */
</script>
</body>
</html>