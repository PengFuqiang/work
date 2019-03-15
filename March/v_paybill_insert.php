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
                        <td><input id='s_roomid1' class='easyui-textbox' style="width:100px"/></td>
                        <td><a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="dosearch()">查询</a></td>
                </tr>
                <tr>
                    <td>房号</td>
                    <td><input id='room_id' class='easyui-textbox' style="width:100px"/></td>
                    <td><input type="radio" name="radio" value="包年">包年</td>
                    <td><input type="radio" name="radio" value="包季">包季</td>
                    <td>赠送</td>
                    <td><input id='zengsong' class='easyui-textbox' style="width:50px" data-options="prompt:'0'" /></td>
                    <td>起始时间</td>
                    <td><a input type="text" class="easyui-datebox" id="selecttime_b"></a></td>
                    <td>结束时间</td>
                    <td><a input type="text" class="easyui-datebox" id="selecttime_e"></a></td>
                </tr>
                <tr>
                    <td>折扣</td>
                    <td><input id='discount' class='easyui-textbox' style="width:50px" data-options="prompt:'10'" /></td>
                    <td>金额</td>
                    <td><input id='amount' class='easyui-textbox' style="width:100px"/></td>
                    <td><a href="#" class="easyui-linkbutton" iconcls="icon-search" onclick="count()">计算</a></td>
                    <td><a href="#" class="easyui-linkbutton" iconcls="icon-add" onclick="insert()">输入按钮</a></td>
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
                        <th field="month_bill" width="50" editor="{type:'textbox',options:{required:true}}">包月费用</th>
                        <th field="type" width="70" editor="text">类别</th>
                        <th field="zengsong" width="70" editor="text">赠送</th>
                        <th field="bill_pay" width="50" editor="text">缴费金额</th>
                        <th field="discount" width="50" editor="text">折扣</th>
                        <th field="time_begin" width="70" editor="text">起始时间</th>
                        <th field="time_end" width="70" editor="text">结束时间</th>
                        <th field="timestamp" width="50" editor="{type:'textbox',options:{readonly:true}}">系统操作时间</th>
                </tr>
        </thead>
        <div id="toolbar01">
    </table>
</div>
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
                        url: 'get_paybill_insert.php'
                });
        }
        function dosearch(){
                $('#table_01').edatagrid({
                        url:"search_paybill_insert.php",
                        queryParams: {
                                room_id: $("#s_roomid1").textbox('getText')
                        }
                });
        }
        
        function count() {
                var time_b = $("#selecttime_b").textbox('getText');
                var time_e = $("#selecttime_e").textbox('getText');
                
                var month_number = 0;
                // var season_number = 0;
                // var year_number = 0;
                var month_money = 0;
                var time_b1= String(time_b)+" 00:00:00";
                var time_e1= String(time_e)+" 00:00:00";
                if(time_e1<time_b1 || time_e1 == null || time_b1==null){
                        alert('请输入正确的起止时间');
                }else{
                        var date1 = time_b.split("-");
                        var date2 = time_e.split("-");
                        if (date1[1] < date2[1]) {
                            month_number = Math.abs(date1[0] - date2[0]) * 12 + Math.abs(date1[1] - date2[1]);
                        } else {
                            month_number = Math.abs(date1[0] - date2[0]) * 12 - Math.abs(date1[1] - date2[1]);
                        }
                        if (date1[2] < date2[2]) {
                            month_number = month_number + 1;
                        }
                        // season_number = Math.ceil(month_number/3);
                        // year_number = Math.ceil(month_number/12);
                     };

                var room_id = $("#room_id").textbox('getText');
                var room_id = String(room_id);
                if (room_id.length != 6) {
                    alert("请输入6位数字房号！");
                } else {
                    var short_room_id = room_id.substr(0,2) + room_id.substr(5,1);
                    var short_room_id_1 = new Array(211,214,221,224,311,314,321,324);
                    var short_room_id_2 = new Array(112,113,122,123,412,413,422,423);
                    var short_room_id_3 = new Array(111,114,121,124,411,414,421,424);
                    var short_room_id_4 = new Array(501,504);
                    var short_room_id_5 = new Array(212,213,222,223,312,313,322,323);
                    var short_room_id_6 = new Array(503);
                    var short_room_id_7 = new Array(502);
                    if (contains(short_room_id_1,short_room_id)) {
                        month_bill = 736;
                    } else if (contains(short_room_id_2,short_room_id)) {
                        month_bill = 787;
                    } else if (contains(short_room_id_3,short_room_id)) {
                        month_bill = 787;
                    } else if (contains(short_room_id_4,short_room_id)) {
                        month_bill = 959;
                    } else if (contains(short_room_id_5,short_room_id)) {
                        month_bill = 1062;
                    } else if (contains(short_room_id_6,short_room_id)) {
                        month_bill = 1210;
                    } else {
                        month_bill = 1590;
                    }
                }

                var type = '';
                var radio = document.getElementsByName("radio");
                for (var i = 0; i < radio.length; i++) {
                    if (radio[i].checked == true) {
                        type = radio[i].value;
                        break;
                    }
                }
                
                var discount = $("#discount").textbox('getText');
                if (discount == '' || discount == undefined || discount == null) {
                    discount = 10;
                }
                var zengsong = $("#zengsong").textbox('getText');
                if (zengsong == '' || zengsong == undefined || zengsong == null) {
                    zengsong = 0;
                }
                var bill_pay;
                if (type == "包季") {
                    month_number = (month_number - zengsong);
                    bill_pay = discount*month_number*month_bill/10;
                } else if (type == "包年") {
                    bill_pay = discount*8*month_bill/10;
                }

                $("#amount").textbox('setValue',bill_pay);
    }

        function insert() {
            var bill_pay = $("#amount").textbox('getText');
            if (bill_pay == '' || bill_pay == undefined || bill_pay == null) {
                // alert('信息输入不完整!');
                return;
            }
            var room_id = $("#room_id").textbox('getText');
            var room_id = String(room_id);
            if (room_id.length != 6) {
                alert("请输入6位数字房号！");
            } else {
                var short_room_id = room_id.substr(0,2) + room_id.substr(5,1);
                var month_bill = 0;
                var short_room_id_1 = new Array(211,214,221,224,311,314,321,324);
                var short_room_id_2 = new Array(112,113,122,123,412,413,422,423);
                var short_room_id_3 = new Array(111,114,121,124,411,414,421,424);
                var short_room_id_4 = new Array(501,504);
                var short_room_id_5 = new Array(212,213,222,223,312,313,322,323);
                var short_room_id_6 = new Array(503);
                var short_room_id_7 = new Array(502);
                if (contains(short_room_id_1,short_room_id)) {
                    month_bill = 736;
                } else if (contains(short_room_id_2,short_room_id)) {
                    month_bill = 787;
                } else if (contains(short_room_id_3,short_room_id)) {
                    month_bill = 787;
                } else if (contains(short_room_id_4,short_room_id)) {
                    month_bill = 959;
                } else if (contains(short_room_id_5,short_room_id)) {
                    month_bill = 1062;
                } else if (contains(short_room_id_6,short_room_id)) {
                    month_bill = 1210;
                } else {
                    month_bill = 1590;
                }
                var type = '';
                var radio = document.getElementsByName("radio");
                for (var i = 0; i < radio.length; i++) {
                    if (radio[i].checked == true) {
                        type = radio[i].value;
                        break;
                    }
                }
                
                var discount = $("#discount").textbox('getText');
                if (discount == '' || discount == undefined || discount == null) {
                    discount = 10;
                }
                var zengsong = $("#zengsong").textbox('getText');
                if (zengsong == '' || zengsong == undefined || zengsong == null) {
                    zengsong = 0;
                }
                var time_begin = $("#selecttime_b").datebox('getValue');
                var time_end = $("#selecttime_e").datebox('getValue');    

                $.ajax({
                url: "update_paybill_insert.php",
                type:"POST",
                data:{
                    room_id:room_id,
                    month_bill:month_bill,
                    type:type,
                    zengsong:zengsong,
                    bill_pay:bill_pay,
                    discount:discount,
                    time_begin:time_begin,
                    time_end:time_end
                }, 
                dataType:"text",
                success: function(data) {//ajax请求成功后触发的方法
                    //alert('请求成功');
                },
                error: function(msg) {//ajax请求失败后触发的方法
                    var msg = JSON.stringify(msg);
                    alert(msg); //弹出错误信息
                }
            });
            }
            window.location.reload();
    }
        function contains(arr, obj) {  
        var i = arr.length;  
        while (i--) {  
            if (arr[i] == obj) {  
                return true;  
            }  
        }  
        return false;  
    }
</script>
</html>