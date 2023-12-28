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
</script>
</body>
</html>