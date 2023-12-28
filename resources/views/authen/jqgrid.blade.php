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

</head>
<body>
    <div class="tableWrap">
        <table id="mainGrid"></table>
        <div id="pager"></div>    
    </div>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var searchResultColNames =  ['이름', '아티스트', '발매', '장르'];
    var searchResultColModel =  [
        {name:'name',   index:'name',   align:'center', hidden:true},
        {name:'artist', index:'artist', align:'left',   width:'24%'},
        {name:'release',index:'release',align:'center', width:'50%'},
        {name:'genre',  index:'genre',  align:'center', width:'26%'}
    ];
    $(document).ready(function(){
        "use strict";
        $("#mainGrid").jqGrid({
            url:" {{ route('jqgriddata')}}",
            dataType:"json",
            mtype: "get",
            colNames : searchResultColNames,
            colModel : searchResultColModel,
            rowNum : 10,
            pager: "#pager",
            height: 261,
            width: 1019,
            caption: "그리드"
        }); //endGRID
    }); //endJQ
    /*  var postData = objConvertJson($("form")); //form 데이터 json으로 변경
    var formData = $('#FORM1').serialize();
    {name:'서버로 넘어오는 ',   index:'정렬시 서버로 넘어가는', align:'데이터정렬'},\
    name : 'response 받아올 변수의 이름',
    index : 'jqGird안에서 접근할 이름',미지정시 name
    -key : 유일한 rowId값을 위해 id를 지정할 수 있습니다. 반드시 하나의 컬럼에만 지정해야하고, 유일한 값
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