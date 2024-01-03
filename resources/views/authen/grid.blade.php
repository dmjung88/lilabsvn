<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToastUiGrid</title>
    {{-- ToastUiGrid CDN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://uicdn.toast.com/grid/latest/tui-grid.css" />
    <script type="text/javascript" src="https://uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.js"></script>
    <script type="text/javascript" src="https://uicdn.toast.com/tui.pagination/v3.3.0/tui-pagination.js"></script>
    <script src="https://uicdn.toast.com/tui-grid/latest/tui-grid.js"></script>
</head>
<body>
    <div id="grid"></div>
    <button type="button">확인</button>
{{-- 스크립트 --}}
<script>
$(function() {
const grid = new tui.Grid({
      el: document.getElementById('grid'),
      data: {
        api: {
          readData: { url: "{{ route('front.gridData')}}", method: 'GET' }
        }
      },
      scrollX: false,
      scrollY: false,
      minBodyHeight: 30,
      rowHeaders: ['rowNum'],
      pageOptions: {
        perPage: 5
      },
      columns: [
        {
          header: 'Name',
          name: 'name'
        },
        {
          header: 'Artist',
          name: 'artist'
        },
        {
          header: 'Type',
          name: 'type'
        },
        {
          header: 'Release',
          name: 'release'
        },
        {
          header: 'Genre',
          name: 'genre'
        }
      ]  
    });
}) //docs

$("button").click(function() {
    $.ajax({
        url :"{{ route('front.gridData')}}",
        method:"GET",
        dataType: "JSON",
        contentType : "application/json; charset=UTF-8",
        success:function(result) {
            console.dir(result);   
        }
    })
});
/*
이벤트 발생
$.ajax({ 
    type: "get or post",
    url: "url()",
    success: function (dataJson) {
        //var json = JSON.parse(dataJson);
        var json = $.parseJSON(dataJson);
        //debugger;
        $("#table").jqGrid({
            data: json,
            datatype: "JSON",
            height: 'auto',
            rowNum: 10,
            rowList: [10, 20, 30],
            colModel: [
                { name: '이름', label: '알리아스',index: 'jqGird안에서 접근할 이름', width: 폭 },
                { name: '이름', label: '별칭', index: 'jqGird안에서 접근할 이름', width: 숫자 }
            ],
            pager: "#페이지",
            sortname: 'P_CODE',
            viewrecords: true,
            sortorder: "desc",            
        });
        jQuery("#table").jqGrid('navGrid', "#페이지", { edit: false, add: false, del: false });

     
    }
});
*/
</script>
</body>
</html>