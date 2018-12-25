<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="../../css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../css/themes/icon.css">
<style type="text/css">
    .line {
        height: 400px;
        width: 100%;
    }
</style>
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.easyui.min.js"></script>

<script src="../../js/easyui-lang-zh_CN.js" charset="utf-8"></script>
<script src="../../js/jquery.edatagrid.js"></script>
<script src="../../js/echarts.js"></script>
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

<div style="width:100%;heigth:100%;background: #eee;" id = "box" class = "line"></div>

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
                getLineChart();
                mygrid01();
              
        })

        function getLineChart() {
            $.ajax({
                url: "worker_app_room_status.php",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    var data_length = getJsonObjLength(data);
                    var on_temp_list = new Array();
                    var off_temp_list = new Array();
                    var timestamp_list = new Array();
                    for (var i = 0; i < data_length; i++) {
                        on_temp_list.push(parseFloat(data[i].room_on_temp).toFixed(1));
                        off_temp_list.push(parseFloat(data[i].room_off_temp).toFixed(1));
                        timestamp_list.push(data[i].timestamp);
                    }
                    var data_x = new Array();
                    var data1 = new Array();
                    var data2 = new Array();
                    if (data_length < 12) {
                        for (var i = data_length-1; i >= 0; i--) {
                            var hour_minute = changeTime(timestamp_list[i]);
                            data_x.push(hour_minute);
                            data1.push(on_temp_list[i]);
                            data2.push(off_temp_list[i]);
                        }
                    } else {
                        for (var i = 11; i >= 0; i--) {
                            var hour_minute = changeTime(timestamp_list[i]);
                            data_x.push(hour_minute);
                            data1.push(on_temp_list[i]);
                            data2.push(off_temp_list[i]);
                        }
                    }
                    var myChart = echarts.init(document.getElementById("box"));
                    var option = {
                        title:  {
                            text: '开关机室温',
                            subtext: '数据来源：鸿图智控'
                        },
                    backgroundColor: '#FBFBFB',
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data:['开机','关机']
                    },
                    calculable: true,
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: data_x,
                        boundaryGap: 0,
                        axisLabel: {
                            rotate:30,
                            interval: 0
                        },
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [
                        {
                            name: '开机',
                            type: 'line',
                            data: data1,
                            markLine:{
                                symbol: "none",
                                itemStyle: {
                                normal: {
                                lineStyle: {
                                color: '#FA3934',
                                },
                                label: {
                                formatter: '虚线:21度水平线',
                                position: 'middle'
                                }
                            },
                        },

                        data: [
                            {
                            name: '21度水平线',
                            yAxis: 21
                            }
                        ]
                    }
                },
                {
                name: '关机',
                type: 'line',
                data: data2
              },

              ]

            };
            myChart.setOption(option);
            } 
            });
        }

        function getJsonObjLength(jsonObj) {
            var Length = 0;
            for (var item in jsonObj) {
                Length++;
            }
            return Length;
        }

        function changeTime(time) {
            var date = new Date(time.replace(/-/g, '/'));
            var format_time = new Date(date);
            var hour_minute = format_time.getHours() + ':' + format_time.getMinutes();
            return hour_minute;
        }
        
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
