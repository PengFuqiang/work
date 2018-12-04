var net = require('net')
    net_server = net.createServer()
var schedule = require("node-schedule") //调用node-schedule模块
var mysql = require('mysql')

var zmdbconn = mysql.createConnection({
	host : '127.0.0.1',
	user : 'root',
	password : 'Wuhanhongtu1712',
	port : '3306',
	database : 'zmdb'
})

zmdbconn.connect(function(err) { 
    if(err) { console.log("连接失败"+err); }
    else{ console.log("连接成功"); }
});

socket_list = []

var rule_balance = new schedule.RecurrenceRule();  
    rule_balance.minute  = 5
schedule.scheduleJob(rule_balance, function(){  
  var request_balance = require('request');
    request_balance('http://zm.hongtupb.com.cn:8888/zm/html/base/count_balance.php', function (error, response, body) {
	})
}); 

var rule_billmax = new schedule.RecurrenceRule();  
    rule_billmax.date  = 1
	rule_billmax.hour  = 0
	rule_billmax.minute  = 1
schedule.scheduleJob(rule_billmax, function(){  
  var request_balance = require('request');
    request_balance('http://zm.hongtupb.com.cn:8888/zm/html/base/bill_monthstart.php', function (error, response, body) {
	})
  var myDate = new Date();
  var query ='UPDATE t_user_dev SET use_billmonthstart=bill,bill_monthstart=bill_dev,monthstart_time='+myDate;
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })
});


var rule_delete     = new schedule.RecurrenceRule();  //设置schedule
	rule_delete.hour  = 19
	rule_delete.minute  = 21	
var auto_delete_old = schedule.scheduleJob(rule_delete,function(){
        var query ='delete from t_update where DATE(timestamp) <= DATE(DATE_SUB(NOW(),INTERVAL 30 day))';
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })
	var query ='delete from t_bill where DATE(timestamp) <= DATE(DATE_SUB(NOW(),INTERVAL 30 day))';
            zmdbconn.query(query,function(err,rows,fields){
                     //   if(err) throw err;
            })
			
	var query ='delete from t_cv_update where DATE(timestamp) <= DATE(DATE_SUB(NOW(),INTERVAL 30 day))';
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })
	var query ='delete from t_update_new where DATE(timestamp) <= DATE(DATE_SUB(NOW(),INTERVAL 1 day))';
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })		
	
})

var bill_save = new schedule.RecurrenceRule();
	bill_save.hour = 9
	bill_save.minute = 5
var auto_save = schedule.scheduleJob(bill_save,function(){
        var query ='INSERT INTO t_bill_forever (room_id,dev_id,dev_type,time_work,time_low,time_mid,time_high,money,timestamp_1) SELECT room_id,dev_id,dev_type,time_work,time_low,time_mid,time_high,money,timestamp FROM t_room_dev';
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })
})

var month_save = new schedule.RecurrenceRule();
	month_save.hour = 8
	month_save.minute = 25
var month_auto_save = schedule.scheduleJob(month_save,function(){
        var query ='INSERT INTO t_bill_month (room_id,bill,bill_use,timestamp) SELECT room_id,bill_dev,bill,update_time FROM t_user_dev';
            zmdbconn.query(query,function(err,rows,fields){
                        if(err) throw err;
            })
})		
	

var rule_ban     = new schedule.RecurrenceRule();  //设置schedule
	rule_ban.hour = [7,12,18]
	rule_ban.minute = 15
var auto_ban = schedule.scheduleJob(rule_ban,function(){
		var query ='select * from t_ban';
			zmdbconn.query(query,function(err,rows,fields){
						if(err) throw err;
						var i=0,usr
						
						var interval_ban = setInterval(function(){     
							usr = rows[i];  
							
							for(var k = 0; k < socket_list.length; k++){
							  if(socket_list[k].D == usr.dev_id){
								socket_list[k].write('{m="ban",g_bs=1,g_bb=0,g_r=0}');
								//break;
							  }
							}
							

							i=i+1;
										
							if (rows[i]==null){
								console.log("发送成功");
								clearInterval(interval_ban);
							};//数据库搜完以后停止set
						},500);//0.5s执行一次
			})
})


var rule_ban_delete = new schedule.RecurrenceRule();  //设置schedule
	rule_ban_delete.hour = [7,12,18]
	rule_ban_delete.minute = 0
var auto_ban_delete = schedule.scheduleJob(rule_ban_delete,function(){
		var query ='select * from t_ban';
			zmdbconn.query(query,function(err,rows,fields){
						if(err) throw err;
						var i=0,usr
						
						var interval_ban_delete = setInterval(function(){     
							usr = rows[i];  
							var room_id = usr.room_id;
								var query ='select * from t_user_dev where room_id='+room_id;
									zmdbconn.query(query,function(err,rows_b,fields){
											if(err) throw err;
											var k=0,usr_b;
											usr_b = rows_b[k];
											if(usr_b.balance_new>0){
												var query ='delete from t_ban where room_id='+room_id;
												zmdbconn.query(query,function(err,rows_b,fields){
													if(err) throw err;
												})
											}											
									})
							
							
							i=i+1;
										
							if (rows[i]==null){
								console.log("发送成功");
								clearInterval(interval_ban_delete);
							};//数据库搜完以后停止set
						},500);//0.5s执行一次
			})
			
			
})

var rule_efficient     = new schedule.RecurrenceRule();  //设置schedule
	rule_efficient.second = [0,30];
var auto_efficient = schedule.scheduleJob(rule_efficient,function(){
		var query ='select * from t_app_schedule';
		var times_now = new Date().getTime();
		
			zmdbconn.query(query,function(err,rows,fields){
						if(err) throw err;
						var usr;
						for(var k=0;k<rows.length;k++){
							usr = rows[k];
							if (usr.opr_time-times_now<60000){
								for(var i = 0; i < socket_list.length; i++){
								  if(socket_list[i].D == usr.dev_id){
									socket_list[i].write('{m="set", g_tt=' + usr.iTargetTemp + ', g_f=' + usr.bFan + ', g_s=' + usr.opr_type + '}');
									socket_list[i].write('{m="fix",c=(function() show_tt(g_tt) show_fan(g_f) end)()}');
								  }
								};

								var query ='DELETE FROM t_app_schedule WHERE opr_time = '+ usr.opr_time;
								zmdbconn.query(query,function(err,rows,fields){
									if(err) throw err;
								})
							}
						}
			})
})


net_server.on('connection', function(socket){
    //console.log(socket.remoteAddress)
	socket.on("data", function(data){
		//console.log('data: '+data+'-'+Date())
		if(data.toString().substring(2,4)!='Md' && data.toString().substring(2,4)!='sM'){
			console.log(data+'-外来数据')
		}else{
			try{
				var data_json = JSON.parse(data.toString())
				switch(data_json.sMethod){
					case "checkIn":
						socket_list.push(socket)
						socket.D = data_json.D
						var d = new Date()
						var g_wk = d.getDay()
						var hour = d.getHours()
						var min = d.getMinutes()
						var g_hh = parseInt(hour/10)
						var g_hl = hour%10
						var g_mh = parseInt(min/10)
						var g_ml = min%10
						socket.write('{m="time", g_wk=' + g_wk + ', g_hh=' + g_hh  + ', g_hl=' + g_hl + ', g_mh=' + g_mh + ', g_ml=' + g_ml + '}')
						
						var query ='insert into t_cv_checkIn set ?'  
						zmdbconn.query(query,{
							devId:data_json.devId	
						},function(err,results){ 
							if(err) { console.log("插入失败"+err) }
						})
					break
					
					case "update":
						var query ='insert into t_cv_update set ?'
						zmdbconn.query(query,{
							devId:data_json.devId,
							iRoomTemp:data_json.iRoomTemp,
							bSwitch:data_json.bSwitch
						},function(err,results){ 
							if(err){ console.log("插入失败"+err); }
						})
					break
				}
				
				switch(data_json.Md){
					case "checkIn":
						socket_list.push(socket)
						socket.D = data_json.D
						var d = new Date();
						var g_wk = d.getDay()
						var hour = d.getHours()
						var min = d.getMinutes()
						var g_hh = parseInt(hour/10)
						var g_hl = hour%10
						var g_mh = parseInt(min/10)
						var g_ml = min%10
						socket.write('{m="time", g_wk=' + g_wk + ', g_hh=' + g_hh  + ', g_hl=' + g_hl + ', g_mh=' + g_mh + ', g_ml=' + g_ml + '}');

					break
			
					case "bill":
						if(data_json.W==undefined || data_json.W==null){break}
						
						var query ='insert into t_bill set ?'
						zmdbconn.query(query,{
							dev_id:data_json.D,
							time_work:data_json.W,
							time_low:data_json.L,
							time_mid:data_json.M,
							time_high:data_json.H
						},function(err,results){ 
							if(err){ console.log("插入失败"+err); }
						})
						
						
						var query='select * from t_room_dev where dev_id = '+data_json.D
						zmdbconn.query(query,function(err,rows,fields){ 
									if(err) throw err;
									if(rows[0]!=undefined ||rows[0] !=null ){
									   if(rows[0].room_id== undefined || rows[0].room_id ==null ){
									   var query ='replace into t_room_dev set ?'
									   zmdbconn.query(query,{
					 				   dev_id:data_json.D,
									   time_work:data_json.W,
									   time_low:data_json.L,
									   time_mid:data_json.M,
									   time_high:data_json.H
									   },function(err,results){ 
									   if(err){ console.log("插入失败1"+err)}
									   })
	
									   }else{
									   var query ='replace into t_room_dev set ?'
									   zmdbconn.query(query,{
									   room_id:rows[0].room_id,
									   dev_id:data_json.D,
									   time_work:data_json.W,
									   time_low:data_json.L,
									   time_mid:data_json.M,
									   time_high:data_json.H
									   },function(err,results){ 
									   if(err){ console.log("插入失败2"+err)}
									   })
									   }
									}else{
									   var query ='insert into t_room_dev set ?'
									   zmdbconn.query(query,{
									   dev_id:data_json.D,
									   time_work:data_json.W,
									   time_low:data_json.L,
									   time_mid:data_json.M,
									   time_high:data_json.H
									   },function(err,results){ 
									   if(err){ console.log("插入失败3"+err)}
									   })
									}
									
									
						})
						
						var query='select * from t_user_money where dev_id = '+data_json.D
						zmdbconn.query(query,function(err,rows,fields){ 
									if(err) throw err;
									if(rows[0]!=undefined ||rows[0] !=null ){
										
									   var query ='update t_user_money set time_now =? where dev_id=?'
									   var updateParams =[data_json.W,data_json.D]
									   zmdbconn.query(query,updateParams,function(err,results){ 
									   if(err){ console.log("更新失败"+err)}
									   })	
							
									}else{
									   var query ='insert into t_user_money set ?'
									   zmdbconn.query(query,{
										   dev_id:data_json.D,
										   time_now:data_json.W
									   },function(err,results){ 
									   if(err){ console.log("插入失败3"+err)}
									   })
									}
									
									
						})	
					break
					
					case "update":
						var query ='insert into t_update set ?'
						zmdbconn.query(query,{
							dev_id:data_json.D,
							dev_switch:data_json.S,
							roomtemp:data_json.R,
							targettemp:data_json.T,
							output:data_json.O
						},function(err,results){ 
							if(err){ console.log("插入失败1"+err); }
						})
						
						
						var query ='replace into t_update_new set ?';  
						zmdbconn.query(query,{
							dev_id:data_json.D,
							switch_S:data_json.S,
							room_temp:data_json.R,
							target_temp:data_json.T,
							output:data_json.O
						},function(err,results){ 
							if(err) {console.log("插入失败2"+err); }
						})
					break
					
					case "fix":
						for(var i = 0; i < socket_list.length; i++){
						  if(socket_list[i].D == data_json.D){
							socket_list[i].write('{m="fix",c='+data_json.c+'}');
							//break;
						  }
						}
					break
					
					case "move":
						for(var i = 0; i < socket_list.length; i++){
						  if(socket_list[i].D == data_json.D){
							socket_list[i].write(data_json.c);
							//break;
						  }
						}
					break
					
					case "set":
						for(var i = 0; i < socket_list.length; i++){
						  if(socket_list[i].D == data_json.devId){
							//check socket writeable
							if(socket_list[i].writable){           
							socket_list[i].write('{m="set", g_tt=' + data_json.iTargetTemp + ', g_f=' + data_json.bFan + ', g_s=' + data_json.bSwitch + '}');
							socket_list[i].write('{m="fix",c=(function() show_tt(g_tt) show_fan(g_f) end)()}');
							}
						  }  
						}
					break
					
					case "getState":
						var devId = data_json.devId;
						zmdbconn.query(
						"select * from t_update_new where dev_id ='"+devId+"'",
						function(err,result){		
					    socket.write(JSON.stringify(result));
						})  
					break
					
					case "getStateList":
						var idList = (data_json.idList).split(",");
						console.log(idList);
						var tempList = [];
						
						for(var i = 0; i < idList.length; i++){
						  tempList[i] = '~';
						};
						
						try{
						  socket.write(tempList.toString());
						  console.log(tempList.toString());
						
						}catch(e){
						  console.log(e);
						}
					break
					
					case "getBalance":
						var room_id = data_json.room_id;
							 zmdbconn.query(
							 "select * from t_user_dev where room_id ='"+room_id+"'",
							 function(err,result){ 
								socket.write(JSON.stringify(result));
								})  
					break
					
					case "getDevTime":
						var idList = (data_json.idList).split(",");
						
						var devtimeList = {};
							for(var i = 0; i < idList.length; i++){
								devtimeList[idList[i]]={
									   dev_time: 0,
									   timestamp: 0 
									   }
							}
							
						 for(var i = 0; i < idList.length; i++){
							 var dev_id = idList[i];	
							 zmdbconn.query("select * from t_bill_new where dev_id ='"+dev_id+"'",
							 function(err,result){
								 devtimeList[idList[i]]={
									dev_time: result[0].time,
									timestamp: result[0].timestamp
									}
								 console.log(devtimeList[idList[i]])
								 return devtimeList;
								})	
						 }
						 
						 var data = {"devtimeList":devtimeList};		
						socket.write(JSON.stringify(data));			 
					break
					
				}
			}catch(e){
				console.log('data: '+data+'-error;'+e)
			}
		}
	})

	socket.on('end',function(){
		console.log("OFF: "+socket.D+' '+Date())
		if(socket.D!=null){delete socket_list[socket.D]}
	})
	
	socket.on('close',function(){
		console.log("CLOSE: "+socket.D+' '+Date())
		if(socket.D!=null){delete socket_list[socket.D]}
	})
	
	socket.on('error',function(){
		console.log("ERROR: "+socket.D+' '+Date())
		if(socket.D!=null){delete socket_list[socket.D]}
	})
})

net_server.listen(9527)
