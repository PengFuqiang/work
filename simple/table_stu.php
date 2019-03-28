<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>加中国际教育</title>

<link href="css/ui.jqgrid-bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/jquery.jqGrid.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/grid.locale-cn.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/layer.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/layer.ext.min.js"></script>
<script type="text/javascript" charset="utf-8" src="js/form.min.js"></script>

	
<script>
	$(function() {
		loadGrid();
	});
	//装载表格
	function loadGrid() {
		 $("#grid").jqGrid(
				{
					height : 600,
					rownumbers : true,
					colModel : [
							{
								label : '姓名',
								name:  'name',
								index: 'name',
								width : 30
							},
							{
								label : '电话',
								 name : 'phone1',
								index : 'phone1', 
								sortable : false,
								width : 30
							},
							{
								label : '父亲',
								 name : 'father',
								index : 'father', 
								sortable : false,
								width : 30
							},
							{
								label : '父亲电话',
								 name : 'phone2',
								index : 'phone2', 
								sortable : false,
								width : 30
							},
							{
								label : '母亲',
								 name : 'mother',
								index : 'mother', 
								sortable : false,
								width : 30
							},
							{
								label : '母亲电话',
								 name : 'phone3',
								index : 'phone3', 
								sortable : false,
								width : 30
							},
							{
								label : '生日',
								 name : 'birthday',
								index : 'birthday', 
								sortable : false,
								width : 30
							},
							{
								label : '家庭住址',
								 name : 'address',
								index : 'address', 
								sortable : false,
								width : 30
							},
							{
								label : '邮箱地址',
								 name : 'email',
								index : 'email', 
								sortable : false,
								width : 40
							},
							{
								label : '入学时间',
								 name : 'joinTime',
								index : 'joinTime', 
								sortable : false,
								width : 30
							},
							{
								label : '学籍类别',
								 name : 'schoolRollType',
								index : 'schoolRollType', 
								sortable : false,
								width : 30
							},
							{
								label : '自我介绍',
								 name : 'introduction',
								index : 'introduction', 
								sortable : false,
								width : 30
							},
							{
								label : '原学籍',
								 name : 'oldSchoolRoll',
								index : 'oldSchoolRoll', 
								sortable : false,
								width : 30
							},
							{
								label : ' ',
								name : 'id',
								width : 60,
								align : 'center',
								sortable : false,
								formatter : function(value, options, row) {
									var btn = "";
									btn += '&nbsp;<a href="javascript:onDtl('
											+ value
											+ ')"class="mesq">查看信息</a>&nbsp;'
									btn += '&nbsp;<a href="javascript:onDel('
											+ value
											+ ')"class="mesd">删除信息</a>&nbsp;'
									return btn;
								}
							} ],
					rowNum : 20,
					rowList : [ 20, 50, 100 ],
					pager : '#pager',
					sortname : 'id',
					sortorder : "desc"
				});

    	$.ajax({
    		type: 'get',
    		url: 'get_all_stu_info.php',
    		dataType: 'json',
    		data: {
    			name: 'name',
    			phone1: 'phone1',
    			father: 'father',
    			phone2: 'phone2',
    			mother: 'mother',
    			phone3: 'phone3',
    			birthday: 'birthday',
    			address: 'address',
    			email: 'email',
    			joinTime: 'joinTime',
    			schoolRollType: 'schoolRollType',
    			introduction: 'introduction',
    			oldSchoolRoll: 'oldSchoolRoll'
    		},
    		success: function(data) {
    			if (data) {
    				var data_length = getJsonObjLength(data);
    				for (var i = 0; i < data_length; i++) {
    					$("#grid").jqGrid('addRowData', i + 1, data[i]);
    				}
    			}
    		}
    	})
	}
	//查看信息
	function onDtl(id){
		$.ajax({
			url: 'get_stu_by_id.php',
			type: "get",
			data: {
				'stu_id': id
			},
			dataType: "json",
    		success: function(result) {
    			var rel = new Array();
    			rel = result.rows[0];
    			$("#window_name").text(rel.name);
    			$("#window_phone1").text(rel.phone1);
    			$("#window_father").text(rel.father);
    			$("#window_phone2").text(rel.phone2);
    			$("#window_mother").text(rel.mother);
    			$("#window_phone3").text(rel.phone3);
    			$("#window_birthday").text(rel.birthday);
    			$("#window_address").text(rel.address);
    			$("#window_email").text(rel.email);
    			$("#window_joinTime").text(rel.joinTime);
    			$("#window_schoolRollType").text(rel.schoolRollType);
    			$("#window_introduction").text(rel.introduction);
    			$("#window_oldSchoolRoll").text(rel.oldSchoolRoll);
    			$('.bgPop,.pop').show();
    			$('.pop-close').click(function () {
            		$('.bgPop,.pop').hide();
        		});
    		},
    		error: function(msg) {//ajax请求失败后触发的方法
                var msg = JSON.stringify(msg);
                alert(msg); //弹出错误信息
            }
		});

	}
	//删除
	function onDel(id) {
		layer.confirm('您确定要删除吗？', 
		{btn : [ '确定', '取消' ]},
		function(){
			$.ajax({
				url :'delete_stu_by_id.php',
				type: "post",
				data: {
					'stu_id': id
				},
				success: function() {
					layer.alert('删除信息成功');
					setTimeout('myrefresh()',1000);
				}
			});
		}
		);
	}
	function myrefresh() {
		window.location.reload();
	}

	//查询
	function onQ() {
		layer.alert("此处为携带"+$("#userName").val()+" 参数执行条件查询");
		var name = $("#userName").val();
		$.ajax({
                url: "search_stu.php",
                type:"GET",
                data:{
                    'name':name
                }, 
                dataType:"json",
                success: function(result) {
                	var rel = new Array();
                	var data_length = getJsonObjLength(result.rows);
    				rel = result.rows[0];
    				if (data_length > 0) {
    					jQuery("#grid").jqGrid("clearGridData");
    					
    						for (var i = 0; i < data_length; i++) {
    							rel = result.rows[i];
    						var data_search = {
    							'name': rel.name,
    							'phone1': rel.phone1,
    							'father': rel.father,
    							'phone2': rel.phone2,
    							'mother': rel.mother,
    							'phone3': rel.phone3,
    							'birthday': rel.birthday,
    							'address': rel.address,
    							'email': rel.email,
    							'joinTime': rel.joinTime,
    							'schoolRollType': rel.schoolRollType,
    							'introduction': rel.introduction,
    							'oldSchoolRoll': rel.oldSchoolRoll
    						};

    						$("#grid").jqGrid('addRowData', i + 1, data_search);
    					}
    					
    				} else {
    					layer.alert('查询无结果');
    				}
    			},
                error: function(msg) {//ajax请求失败后触发的方法
                    var msg = JSON.stringify(msg);
                    alert(msg); //弹出错误信息
                }
            });
	}
	//显示全部
	function showAll() {
		layer.alert("显示全部数据！");
		jQuery("#grid").jqGrid("clearGridData");
		$.ajax({
    		type: 'get',
    		url: 'get_all_stu_info.php',
    		dataType: 'json',
    		data: {
    			name: 'name',
    			phone1: 'phone1',
    			father: 'father',
    			phone2: 'phone2',
    			mother: 'mother',
    			phone3: 'phone3',
    			birthday: 'birthday',
    			address: 'address',
    			email: 'email',
    			joinTime: 'joinTime',
    			schoolRollType: 'schoolRollType',
    			introduction: 'introduction',
    			oldSchoolRoll: 'oldSchoolRoll'
    		},
    		success: function(data) {
    			if (data) {
    				var data_length = getJsonObjLength(data);
    				for (var i = 0; i < data_length; i++) {
    					$("#grid").jqGrid('addRowData', i + 1, data[i]);
    				}
    			}
    		}
    	})
	}
	//窗口变化时自适应宽度
	window.onresize = function() {
		$("#grid").setGridWidth(document.body.clientWidth - 12);
	}

	function getJsonObjLength(jsonObj) {
        var Length = 0;
        for (var item in jsonObj) {
            Length++;
        }
        return Length;
    }
</script>
</head>

<body>
<style>
	.in {
		height:30px;
		border-radius:4px;
	}
	.getS {
		background:#69Ea7c;
		color:#fff;
		padding:5px;
		padding-left:20px;
		padding-right:20px;
		border-radius:4px;
	}
	.getS:HOVER {
		background:#49D44d;
		cursor:pointer;
	}
	.mesd {
		color:#C12E2A
	}
	.mesq {
		color:#4CAE4C
	}


    .pop {  
    	display: none;  
    	width: 600px; 
    	min-height: 470px;  
    	max-height: 1000px;  
    	height:750px;  
    	position: absolute;  
    	top: 30px;  
    	left: 0;  
    	bottom: 0;  
    	right: 0;  
    	margin: auto;  
    	padding: 25px;  
    	z-index: 130;  
    	border-radius: 8px;  
    	background-color: #fff;  
    	box-shadow: 0 3px 18px rgba(100, 0, 0, .5);  
    }
    .pop-top{
      	height:40px;  
      	width:100%;  
      	border-bottom: 1px #E5E5E5 solid;  
  	}
    .pop-top h2 {
      	float: left;  
      	display:black
  	}
    .pop-top input {
      	float: right;  
      	cursor: pointer; 
      	display:black
  	}
    .pop-cancel, .pop-ok {  
    	padding:8px 15px;  
    	margin:15px 5px;  
    	border: none;  
    	border-radius: 5px; 
    	background-color: #337AB7;  
    	color: #fff;  
    	cursor:pointer; 
    }
    .pop-cancel { 
     	background-color: #FFF;  
     	border:1px #CECECE solid; 
      	color: #000;  
  	}
    .pop-content {
      	height: auto;  
  	}
    .pop-content-left {
      	float: left;  
  	}
    .pop-content-right {
      	width:310px;  
      	float: left;  
      	padding-top:20px;  
      	padding-left:20px;  
      	font-size: 16px;  
      	line-height:35px;  
  	}
    .bgPop { 
     	display: none;  
     	position: absolute;  
     	z-index: 129;  
     	left: 0;  
     	top: 0;  
     	width: 100%;  
     	height: 100%;  
     	background: rgba(0,0,0,.2); 
    }
</style>
		 <div style="padding-Top:5px;background:#ddd;height:40px">
			<label style="margin-left:45px">姓名：</label> <input class="in" id="userName" placeholder="  查询信息"/>
			<label onclick="onQ()" class="getS"> 查 询 </label>	
			<label onclick="showAll()" class="getS"> 显示全部</label>	
			<label onclick="javascript:window.history.back(-1);" class="getS"> 返 回 </label>
		 </div>
		<div class="row">
			<div class="col-sm-12" style="background:#eee">
				<table id="grid" style="background:#eff"></table>
				<div id="pager" style="height:35px;"></div>
			</div>
		</div>
		<div class="pop">
	    	<div class="pop-top">
	        	<h2>详细信息</h2>
		        <input type="button" value="关闭" class="pop-cancel pop-close"/>
		    </div>
		    <div class="pop-content">
		        <div class="pop-content-left">
		            <img src="" alt="" class="teathumb">
		        </div>
		        <div class="pop-content-right">
		            <p>学生姓名：<b id="window_name"></b></p>
		            <p>学生电话：<b id="window_phone1"></b></p>
		            <p>父亲：<b id="window_father"></b></p>
		            <p>父亲电话：<b id="window_phone2"></b></p>
		            <p>母亲：<b id="window_mother"></b></p>
		            <p>母亲电话：<b id="window_phone3"></b></p>
		            <p>生日：<b id="window_birthday"></b></p>
		            <p>家庭住址：<b id="window_address"></b></p>
		            <p>邮箱地址：<b id="window_email"></b></p>
		            <p>入学时间：<b id="window_joinTime"></b></p>
		            <p>学籍类别：<b id="window_schoolRollType"></b></p>
		            <p>自我介绍：<b id="window_introduction"></b></p>
		            <p>原学籍：<b id="window_oldSchoolRoll"></b></p>
		        </div>
		    </div>
		</div>
</body>
</html>