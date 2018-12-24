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
        <table id="table_02"  cellspacing='5'>
            <tr>
                <td>设备号</td>
                <td><input id='s_devid' class='easyui-textbox' style="width:100px"/></td>
                <td><a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="dosearch()">查询</a></td>
                <td><a href="#" class="easyui-linkbutton" iconcls="icon-reload" onclick="mygrid01()">刷新</a></td>
                <td><a href="#" class="easyui-linkbutton" iconcls="icon-reload" onclick="dosearch_on()">开机面板查询</a></td>
                <td>    在线面板</td>
                <td><input id="total" class="easyui-textbox" style="width:50px"></td>
                <td>    开机面板</td>
                <td><input id="dev_on" class="easyui-textbox" style="width:50px"></td>
                <td>    关机面板</td>
                <td><input id="dev_off" class="easyui-textbox" style="width:50px"></td>
           </tr>
        </table>
        <table>
           <tr>
                <td>开机面板室内平均温度</td>
                <td><input id="room_on_temp" class="easyui-textbox" style="width:60px"></td>
                <td>未开机面板室内平均温度</td>
                <td><input id="room_off_temp" class="easyui-textbox" style="width:60px"></td>
                <td>开机面板设定温度</td>
                <td><input id="room_on_set" class="easyui-textbox" style="width:60px"></td>
                <td>开机温度达到19度用户</td>
                <td><input id="room_on_18" class="easyui-textbox" style="width:60px"></td>

           </tr>
        </table>



<div style="width:100%;heigth:100%;background: #eee;">
        <table id="table_01" style="width:100%;heigth:100%;"
           toolbar="#toolbar01" pagination="true" idfield="id"
           rownumbers="true" fitcolumns="true" striped="true"
           singleselect="false">
        <thead>
                <tr>
                        <th field="dev_id" width="50" editor="text">设备号</th>
                        <th field="switch_S" width="50" editor="text">面板开关</th>
                        <th field="room_temp" width="50" editor="text">房间温度</th>
                        <th field="target_temp" width="50" editor="text">设定温度</th>
                        <th field="output" width="50" editor="text">档位</th>
                        <th field="timestamp" width="50" editor="text">更新时间</th>

                </tr>
        </thead>
        </table>
</div>
</tr>
<div style="width:100%;heigth:100%;background: #eee;">
        <table id="table_03" style="width:100%;heigth:100%;"
           toolbar="#toolbar01" pagination="true" idfield="id"
           rownumbers="true" fitcolumns="true" striped="true"
           singleselect="false">
        <thead>
                <tr>
                        <th field="room_id" width="50" editor="text">房号</th>
                        <th field="dev_id" width="50" editor="text">设备号</th>
                        <th field="room_type" width="50" editor="text">房间</th>
                        <th field="fan_sp" width="50" editor="text">风机型号</th>
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
                        onLoadSuccess:function(data){
                        $('#total').textbox('setValue',data.total);
                
                        $('#dev_on').textbox('setValue',data.dev_on);
                        $('#dev_off').textbox('setValue',data.dev_off);
                        $('#room_on_temp').textbox('setValue',data.room_on_temp);
                        $('#room_off_temp').textbox('setValue',data.room_off_temp);
                        $('#room_on_set').textbox('setValue',data.room_on_set);
                        $('#room_on_18').textbox('setValue',data.room_on_18);
                },

                                                  
                        url: 'get_data11.php'
                     
                });
               
                
        }
        
                
        function dosearch(){
                $('#table_01').edatagrid({
                        url:"search_data11.php",
                        queryParams: {
                                s_devid: $("#s_devid").textbox('getText')
                        }
                });
        }
        
        function dosearch_on(){
                $('#table_01').edatagrid({
                        url:"search_data11_on.php",
                                                onLoadSuccess:function(data){
                                                        var total=data.total;
                                                        if(total>10){
                                                                total=10;
                                                        };
                                                        var dev_ids="";
                                                        for(var i=0;i<total;i++){
                                                                var dev_id_i= data.rows[i].dev_id;
                                                                if (dev_ids.length==0){
                                                                        dev_ids=dev_id_i;
                                                                }else{
                                                                        dev_ids=dev_ids+","+dev_id_i;
                                                                }
                                                        }
                                                        $('#table_03').edatagrid({
                                                                url:"search_data11_roomid_on.php",
                                                                queryParams: {
                                                                        s_devids: dev_ids
                                                                }
                                                        });
                                                }
                });
        }

</script>
