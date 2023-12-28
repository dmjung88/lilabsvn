<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Your page title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/css/ui.jqgrid.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.5/jquery.jqgrid.min.js"></script>
    <script>
    $(function () {
        "use strict";
        $("#grid").jqGrid({
            url:" {{ route('jqgriddata')}}",
            dataType:"json",
            mtype: "get",
            colNames : ['이름', '아티스트', '발매', '장르'],
            colModel : [
                {name:'name',   index:'name',   align:'center', hidden:true},
                {name:'artist', index:'artist', align:'left',   width:'24%'},
                {name:'release',index:'release',align:'center', width:'50%'},
                {name:'genre',  index:'genre',  align:'center', width:'26%'}
            ],
            caption: "그리드"
        }); //endGRID
    }); //endJQ
    </script>
</head>
<body>
<table id="grid"></table>
</body>
</html>