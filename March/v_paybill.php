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
        <table cellspacing='5'>
                <tr>
                        <td>房号</td>
                        <td><input id='s_roomid' class='easyui-textbox' style="width:100px"/></td>
                        <td><a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="dosearch()">查询</a></td>

            <td>选择日期</td>
            <td><a input type="text" class="easyui-datebox" id="selecttime_b"></a></td>
            <td><a input type="text" class="easyui-datebox" id="selecttime_e"></a></td>
            <td><a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="dosearch_time()">时段查询</a></td>
            <td>总金额<input id='pay_all' class='easyui-textbox' style="width:100px"/></td>
            <td>现场<input id='pay_local' class='easyui-textbox' style="width:100px"/></td>
            <td>APP<input id='pay_app' class='easyui-textbox' style="width:100px"/></td>
        </tr>
        </table>
<div style="width:100%;heigth:100%;background: #eee;">
        <table id="table_01" style="width:100%;heigth:100%;"
           toolbar="#toolbar01" pagination="true" idfield="id"
           rownumbers="true" fitcolumns="true" striped="true"
           singleselect="false">
        <thead>
                <tr>
                        <th field="room_id" width="50" editor="{type:'textbox',options:{required:true}}">房号</th>
                        <th field="bill_pay" width="50" editor="{type:'textbox',options:{required:true}}">缴费金额</th>
                        <th field="bill_type" width="50" editor="text">缴费方式</th>
                        <th field="note" width="70" editor="text">缴费类别</th>
                        <th field="note_locale" width="170" editor="text">备注</th>
                        <th field="pay_time" width="70" editor="text">缴费时间</th>
                        <th field="timestamp" width="50" editor="{type:'textbox',options:{readonly:true}}">系统操作时间</th>
                </tr>
        </thead>
        <div id="toolbar01">
    </table>
</div>
<hr/>
<form method="post" action="download_data02.php" enctype="multipart/form-data">
        <h3>导出CSV表：</h3>
        <input type="submit"  value="导出" />
</form>
<hr/>
<script language="javascript"> 
    function delcfm() { 
        if (!confirm("确认要清空吗？")) { 
            window.event.returnValue = false; 
        } 
    } 
</script>
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
                        url: 'get_data02.php'
                });
        }
        function dosearch(){
                $('#table_01').edatagrid({
                        url:"search_data02.php",
                        queryParams: {
                                s_roomid: $("#s_roomid").textbox('getText')
                        }
                });
        }
        
        function dosearch_time(){
                var time_b = $("#selecttime_b").textbox('getText');
                var time_e = $("#selecttime_e").textbox('getText');
                time_b= String(time_b)+" 00:00:00";
                time_e= String(time_e)+" 00:00:00";
                //      alert(time_b);
                if(time_e<time_b || time_e == null || time_b==null){
                        alert('请输入正确的起止时间');
                }else{
                        $('#table_01').edatagrid({
                                url:"search_data02_time.php",
                                queryParams: {
                                        selecttime_b: time_b,
                                        selecttime_e: time_e
                                },
                                onLoadSuccess:function(data){
                                        $('#pay_all').textbox('setValue',data.pay_all);
                                        $('#pay_local').textbox('setValue',data.pay_local);
                                        $('#pay_app').textbox('setValue',data.pay_app);
                                        }
                        });
                        /*
                        $.ajax({
                                type: "GET",
                                url: "search_data02_money.php",
                                dataType: "json",
                                async:false,
                                success: function(data){
                                                $('#pay_all').textbox('setValue',data.pay_all);
                                                $('#pay_local').textbox('setValue',data.pay_local);
                                                $('#pay_app').textbox('setValue',data.pay_app);
                                        },
                                error: function(data){
                                
                        }
                        })*/ 
                     };
    }
</script>
</html>