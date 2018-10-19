<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="../../css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../css/themes/icon.css">
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.easyui.min.js"></script>

<script src="../../js/easyui-lang-zh_CN.js" charset="utf-8"></script>
<script src="../../js/jquery.edatagrid.js"></script>
</head>

<body style="font-size:12px">
<div style="width:100%;heigth:100%;background: #eee;">
    <table id="table_01" style="width:100%;heigth:100%;"
       toolbar="#toolbar01" pagination="true" idfield="id"
       rownumbers="true" fitcolumns="true" striped="true"
       singleselect="false">
    <thead>
        <tr>
            <th field="time_period" width="50" editor="text">时间段</th>
            <th field="nums" width="50" editor="text">使用数量</th>
        </tr>
    </thead>
    </table>
</div>
<hr/>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        mygrid01();
    }) 
    
    function mygrid01() {
        $('#table_01').edatagrid({
            onError: function(index, data){
                $.messager.alert('警告','出错了! <br/>出错位置= '+index+' <br/>错误内容= '+data.isError);
            },
            destroyMsg:{
                norecord:{    // 在没有记录选择的时候执行
                    title:'警告',
                    msg:'没有选中任何记录。'
                },
                confirm:{       // 在选择一行的时候执行     
                    title:'确认',
                    msg:'确定要删除吗？'
                }
            },
            url: 'get_data17.php',


        });
    }
</script>
