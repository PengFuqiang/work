<?php
session_start();
if(!isset($_SESSION['usertype'])){
    header("Location:../../login.php");
    exit();
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="../../css/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../../css/themes/icon.css">
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.jqprint-0.3.js"></script>
<script type="text/javascript" src="../../js/jquery-migrate-1.4.1.min.js"></script>  <!--加入辅助插件，解决Cannot read property 'opera' of undefined-->
<script src="../../js/jquery.easyui.min.js"></script><!--导入顺序不同会出错-->

<script src="../../js/easyui-lang-zh_CN.js" charset="utf-8"></script>
<script src="../../js/jquery.edatagrid.js"></script>
<style>
  .printArea { display:none;}
</style>
<style media="print">.printArea { display:block;}</style>
</head>

<body style="font-size:14px">
                <table>
                        <tr>
                                <tr><td>缴费类别</td>
                                <td><input type="radio" name="radio2" value="KTF" checked>空调收费
                                <input type="radio" name="radio2" value="FWF">有偿服务</td>

                                <tr><td>缴费方式</td>
                                <td><input type="radio" name="radio" value="01" checked>微信支付宝
                                <input type="radio" name="radio" value="00">刷卡</td>

                                <tr><td>缴费金额</td>
                                <td><input id='money' name="money" class='easyui-textbox' maxlength=10 style="width:200px"/></td></tr>

                                <tr><td>房号(6位数字:703202)</td>
                                <td><input id='s_roomid' name="s_roomid" class='easyui-textbox' size=6 maxlength=6 style="width:200px"/></td>

                                <tr><td>扫码信息(微信支付宝点击此框扫码输入)</td>
                                <td><input  id='pay_num' name='pay_num' class='easyui-textbox' size=50 maxlength=50 style="width:200px"/></td></tr>

                                <tr><td>备注</td>
                                <td><input id='note' name='note' class='easyui-textbox' style="width:200px"/></td></tr>

                                <tr><td><a href="#" class="easyui-linkbutton" iconcls="icon-add" onclick="docreate()">创建订单</a></td></tr>

                                <tr><td><a href="#" class="easyui-linkbutton" iconcls="icon-add" onclick="doreceipt()">打印收据</a></td></tr>

                                <tr>
                                        <id="result9">
                                        <input type="button" name="confirmBtn" value="签到" onclick="javascript:confirm9()">

                                </tr>

                                <tr>
                                        <id="result10">
                                        <input type="button" name="confirmBtn" value="结算" onclick="javascript:confirm10()">

                                </tr>
                        </tr>
                </table>

                <div id="printArea" class="printArea" media="print" >

                  <p class="note_date" id="note_date_y" style="position:absolute;left:390px;top:35px" ></p>  <!--缴费日期-->
                  <p class="note_date" id="note_date_m" style="position:absolute;left:470px;top:35px" ></p>  <!--缴费日期-->
                  <p class="note_date" id="note_date_d" style="position:absolute;left:540px;top:35px" ></p>  <!--缴费日期-->
                  <p class="note_num" id="note_num" style="position:absolute;left:150px;top:30px'" ></p>  <!--收据编号-->
                  <p class="note_village" id="note_village" style="position:absolute;left:300px;top:90px" >中民</p><!--小区名称-->
                  <p class="note_roomid" id="note_roomid" style="position:absolute;left:300px;top:145px" ></p><!--交款单位-->
                  <p class="note_paytype" id="note_paytype" style="position:absolute;left:580px;top:145px" ></p><!--收款方式：现场刷卡/微信支付宝-->
                  <p class="note_moneyc" id="note_moneyc" style="position:absolute;left:280px;top:200px" ></p><!--收款金额大写-->
                  <p class="note_moneyn" id="note_moneyn" style="position:absolute;left:580px;top:200px" ></p><!--收款金额数字-->
                  <p class="note_reason" id="note_reason" style="position:absolute;left:280px;top:260px" ></p><!--收款事由：空调费/有偿服务+备注-->
                </div>


</body>

<script type="text/javascript">
        var DUmsocx1;
        var ws;
        var flag=0;
        var print_flag=0;
        function ToggleConnectionClicked() {          
         try {
          
                  //检测当前浏览器是否支持websocket模式
                  window.WebSocket = window.WebSocket || window.MozWebSocket;
                                        if (!window.WebSocket){
                                                                alert("WebSocket not supported by this browser");
                                                                return;
                                        }
                  ws = new WebSocket("ws://127.0.0.1:1818");//连接服务器        

                        ws.onopen = function(event){
                                //alert("已经与服务器建立了连接\r\n当前连接状态："+this.readyState);
                                flag=0;
                                ws.send(DUmsocx1);
                                //SendData(DUmsocx1);   
                                };
                        ws.onmessage = function(event){
                                //判断返回数据是否一致，存入缴费记录
                                var money = $("#money").textbox('getText');
                                var money_y=money;
                                        money=money*100;
                                var len_m = money.toString().length;
                                while(len_m < 12) {
                                        money = "0" + money;
                                        len_m++;
                                };
                                var room_id = $("#s_roomid").textbox('getText');
                                var room_id = String(room_id);
                                var pay_num = document.getElementById("pay_num").value;
                                var note = $("#note").textbox('getText');
                                
                                var pay_type='';
                                var radio = document.getElementsByName("radio");
                                for(var i = 0;i<radio.length;i++)
                                {
                                        if(radio[i].checked==true)
                                        {pay_type = radio[i].value;
                                        break;}
                                };
                                        pay_type_c='刷卡';
                                }else{
                                        pay_type_c='微信支付宝';
                                };
                        
                                var rceice_data=event.data;
                                $.post("save_data_detail.php", { data_detail:rceice_data} );
                                var flag_pay=rceice_data.substr(0,2);
                                var money_pay=rceice_data.substr(32,12);
                                var bill_type=rceice_data.substr(141,3);
                                //alert(event.data+'XXXX'+(event.data).length+'XXXX'+bill_type);
                                //alert((event.data).length);
                                //alert(bill_type);
                                var today = new Date();    
                                var day   = today.getDate(); //获取当前日(1-31)      
                                var month = today.getMonth() + 1; //显示月份比实际月份小1,所以要加1  
                                var year  = today.getYear();  
                                var years=today.getFullYear();
                                        years= years<99?"20"+years:years;
                                        year = String(year).slice(-2);
                                month    = month<10?"0"+month:month;  //数字<10，实际显示为，如5，要改成05  
                                day   = day<10?"0"+day:day;  
                                var hh=today.getHours();
                                hh   = hh<10?"0"+hh:hh;  
                                var ii=today.getMinutes();
                                ii   = ii<10?"0"+ii:ii;  
                                var ss= today.getSeconds();
                                ss   = ss<10?"0"+ss:ss;  
                                var dada = years+"-"+month+"-"+day+" "+hh+":"+ii;
                                var pay_num_old = String(dada);//订单号

                                
                                
                                if(room_id.length==6 && flag_pay=='00' && money_pay == money){
                                        
                                        
                                        print_flag=1;
                                        
                                        alert(room_id+"缴费成功,缴费金额为"+ money_y +"元！");
                                        
                                        
                                }else{
                                        alert("接收到服务器发送的数据：\r\n"+event.data);
                                }
                                flag=1;
                        };
                        
                        ws.onclose = function(event){
                                //alert("已经与服务器断开连接\r\n当前连接状态："+this.readyState);
                                };
                                
                        ws.onerror = function(event){
                                if (flag!=1)
                                alert("WebSocket异常！");
                                };
                } catch (ex) {
                         alert(ex.message);      
                        }
        };

        function docreate(){
        
                var bill_type=''; //获取有偿服务或是空调缴费
                var radio2 = document.getElementsByName("radio2");
                for(var i = 0;i<radio2.length;i++)
                {
                        if(radio2[i].checked==true)
                        {bill_type = radio2[i].value;
                        break;}
                }
                
                var today = new Date();    
                var day   = today.getDate(); //获取当前日(1-31)      
                var month = today.getMonth() + 1; //显示月份比实际月份小1,所以要加1  
                var year  = today.getYear();  
                var years=today.getFullYear();
                        years= years<99?"20"+years:years;
                        year = String(year).slice(-2);
                month    = month<10?"0"+month:month;  //数字<10，实际显示为，如5，要改成05  
                day   = day<10?"0"+day:day;  
                var hh=today.getHours();
                hh   = hh<10?"0"+hh:hh;  
                var ii=today.getMinutes();
                ii   = ii<10?"0"+ii:ii;  
                var ss= today.getSeconds();
                ss   = ss<10?"0"+ss:ss;  
                var dada = year+month+day+hh+ii+ss;//时间不能直接相加，要这样相加！！！12位
                var dadatime = String(years)+String(month)+String(day);
                var pay_num_old = String(dada);//订单号
                var pay_time = String(dadatime);//订单日期
                
                var pay_type='';  //刷卡或者支付宝微信
                var radio = document.getElementsByName("radio");
                for(var i = 0;i<radio.length;i++)
                {
                        if(radio[i].checked==true)
                        {pay_type = radio[i].value;
                        break;}
                }
        
                
                var money = $("#money").textbox('getText');
                var money_y=money;
                money=money*100;
                var len_m = money.toString().length;
                while(len_m < 12) {
                        money = "0" + money;
                        len_m++;
                };
                var room_id = $("#s_roomid").textbox('getText');
                var room_id = String(room_id);
                if(room_id.length!=6){
                alert("请输入6位数字房号！");
                }else{
                DUmsocx1= pay_type  +room_id + '00' + 'A0000'+bill_type+'00' + money + 
                                pay_time + pay_num_old + room_id + bill_type + document.getElementById("pay_num").value;
            
               // alert(DUmsocx1);
                //alert(DUmsocx1.length);
                
                ToggleConnectionClicked();   
                };
        }
                
                function doreceipt()
                {       //var print_flag=1;
                        if(print_flag==1){
                                var bill_type=''; //获取有偿服务或是空调缴费
                                var radio2 = document.getElementsByName("radio2");
                                for(var i = 0;i<radio2.length;i++)
                                {
                                        if(radio2[i].checked==true)
                                        {bill_type = radio2[i].value;
                                        break;}
                                }
                                if(bill_type=='KTF'){
                                        var note_billreason ='空调费';
                                }else{
                                        var note_billreason ='有偿服务';
                                }
                                var note = $("#note").textbox('getText');
                                
                                var note_reason=note_billreason+note;
                                $("#note_reason").html(note_reason);  //收款事由
                                
                                
                                var today = new Date();    
                                var day   = today.getDate(); //获取当前日(1-31)      
                                var month = today.getMonth() + 1; //显示月份比实际月份小1,所以要加1  
                                var year  = today.getYear();  
                                var years=today.getFullYear();
                                        years= years<99?"20"+years:years;
                                        year = String(year).slice(-2);
                                month    = month<10?"0"+month:month;  //数字<10，实际显示为，如5，要改成05  
                                day   = day<10?"0"+day:day;  
                                var hh=today.getHours();
                                hh   = hh<10?"0"+hh:hh;  
                                var ii=today.getMinutes();
                                ii   = ii<10?"0"+ii:ii;  
                                var ss= today.getSeconds();
                                ss   = ss<10?"0"+ss:ss;  
                                var dada = year+month+day+hh+ii+ss;//时间不能直接相加，要这样相加！！！12位收据编号
                                var dadatime = years+month+day;
                                $("#note_date_y").html(years);  //入账时间
                                $("#note_date_m").html(month);  //入账时间
                                $("#note_date_d").html(day);  //入账时间
                                $("#note_num").html(dada);//收据编号
                                
                                var room_id = $("#s_roomid").textbox('getText');
                                $("#note_roomid").html(room_id); //交款单位
                                
                                var pay_type='';  //刷卡或者支付宝微信，收款方式
                                var radio = document.getElementsByName("radio");
                                for(var i = 0;i<radio.length;i++)
                                {
                                        if(radio[i].checked==true)
                                        {pay_type = radio[i].value;
                                        break;}
                                }
                                if(pay_type=='00'){
                                        var note_paytype ='刷卡';
                                }else{
                                        var note_paytype ='微信支付宝';
                                }
                                $("#note_paytype").html(note_paytype);
                                
                                var money = $("#money").textbox('getText');//缴费人民币
                                money *= 100;
                                money += "";
                                var length = money.length;
                                var unit = new Array("仟", "佰", "拾", "", "仟", "佰", "拾", "", "角", "分");
                                var moneyc = "";
                                for (var i = 0; i < length; i++) {
                                        if (i == 2) {
                                                moneyc = "元" + moneyc;
                                        } else if (i == 6) {
                                                moneyc = "万" + moneyc;
                                        }
                                        if (money.charAt(length - i - 1) == 0) {
                                                if (i != 0 && i != 1) {
                                                        if (moneyc.charAt(0) != '零' && moneyc.charAt(0) != '元' && moneyc.charAt(0) != '万') {
                                                                moneyc = "零" + moneyc;
                                                        }
                                                }
                                                continue;
                                        }
                                        moneyc = toDx(money.charAt(length - i - 1)) + unit[unit.length - i - 1] + moneyc;
                                }
                                moneyc += moneyc.charAt(moneyc.length - 1) == '元' ? "整" : "";

                                function toDx(n) {
                                        switch (n) {
                                                case "0":
                                                        return "零";
                                                case "1":
                                                        return "贰";
                                                case "3":
                                                        return "叁";
                                                case "4":
                                                        return "肆";
                                                case "5":
                                                        return "伍";
                                                case "6":
                                                        return "陆";
                                                case "7":
                                                        return "柒";
                                                case "8":
                                                        return "捌";
                                                case "9":
                                                        return "玖";
                                        }
                                }
                                money=money/100;
                                $("#note_moneyc").html(moneyc);//缴费人民币大写
                                $("#note_moneyn").html(money);//缴费人民币数字
                                
                                //$("#note_user").html(<%=session("username")%>);
                                
                                $.ajax({    
                                        url: 'receipt_save.php',  
                                        type:"Post",  
                                        data:{  room_id:room_id,
                                                        note_reason:note_reason,
                                                        dada:dada,
                                                        money:money
                                        }  
                                }); 
                                
                                $("#printContainer").jqprint({
                                         debug: false, //如果是true则可以显示iframe查看效果（iframe默认高和宽都很小，可以再源码中调大），默认是false
                                         importCSS: false, //true表示引进原来的页面的css，默认是true。（如果是true，先会找$("link[media=print]")，若没有会去找$("link")>中的css文件）
                                         printContainer: true, //表示如果原来选择的对象必须被纳入打印（注意：设置为false可能会打破你的CSS规则）。
                                         operaSupport: true//表示如果插件也必须支持歌opera浏览器，在这种情况下，它提供了建立一个临时的打印选项卡。默认是true
                                });
                                
                                
                                print_flag=0;
                                $("#printArea").jqprint();
                                }else{
                                        alert("请先缴费再开收据！");
                                }
                                        
                }

                function confirm9()
                {               
                        DUmsocx1='00' +"876543211234567805" + '000000000001' + 
                                '20110000' +'000000000000' +
                                '000000' + "YOU";
                        ToggleConnectionClicked();              
                }
                
                function confirm10()
                {       
                        DUmsocx1='00' +"876543211234567806" + '000000000001' + 
                                '20110000' +'000000000000' +
                                '000000' + "YOU";
                        ToggleConnectionClicked();
                }
</script>