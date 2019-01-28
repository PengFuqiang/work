<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>加中国际教育</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/index.css">
	
</head>
<body>
	<!--页面的全部部分-->
	<div id="container">
		<!--页面的头部：logo、导航..-->
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/allimgs/logo1.png" alt=""></a>
			</div>
			<div id="nav">
				<ul>
					<a href="index.php"><li>全部课程</li></a>
					<a href="my.php"><li>我的课程</li><a/>
					<a href="photo.php"><li>图书专栏</li></a>
					<a href="app.php"><li>APP下载</li></a>
				</ul>
			</div>
			<div id="denglu">
				<?php
                    session_start();
                ?>
                	<a href="tuichu.php?action=logout">退出</a>
                	<a href="">欢迎：<?php echo $_SESSION['username'];?></a>
			</div>
		</div>
		
		<div id="banner">
			<div id="form_left" style="height: 3px;">

			</div>
			<!--form表单部分结束-->
		</div>
		<!--我的课程部分开始-->
		<div id="section">
		</div>
		<!--我的课程部分结束-->
	


		<!--页面底部开始-->
		<div id="footer">
			<div class="footer_one">
				<img style="width:196px;height: 52px;margin:30px;" src="images/allimgs/logo1.png" alt="">
			</div>
			<div class="footer_two">
				<p>我们只为教师    400-9678-006(9：00-18：00)</p>
				<p id="p_2">京ICP备15012680号|京公网安备号11010802017208</p>
			</div>
			<div class="footer_three">
				<ul>
					<a href="#"><li>使用说明</li></a>
					<a href="#"><li>关于我们</li></a>
					<a href="#"><li>加入我们</li></a>
					<a href="#"><li>服务条款</li></a>
				</ul>
			</div>
			<div class="footer_four">
				<a href="#"><img src="images/allimgs/qq.png" alt=""></a>
				<a href="#"><img src="images/allimgs/wb.png" alt=""></a>
				<a href="#"><img src="images/allimgs/pic.gif" alt=""></a>
			</div>
		</div>
		<!--页面底部结束-->
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
        loadMyCourse();
    });
    function loadMyCourse() {
    	$.ajax({
    		url: 'get_myCourseId.php',
    		type: 'GET',
    		data: {
    			course_id: 'course_id',
    			course_info: 'course_info',
    			course_img: 'course_img',
    			course_name: 'course_name'
    		},
    		dataType: 'json',
    		success: function(data) {
    			if (data) {
    				var length = getJsonObjLength(data);
    				for (var i = 0; i < length; i++) {
    							var div = document.getElementById("section");
		    					var div1 = document.createElement("div");
		    					var divattr = document.createAttribute("class");
		    					divattr.value = "alldiv";
		    					div1.setAttributeNode(divattr);
		    					div.appendChild(div1);		

		    					var ul = document.createElement("ul");
		    					ul.id = "alldiv_ul";
		    					div1.appendChild(ul);		

		    					var liObj = document.createElement("li");
		    					ul.appendChild(liObj);		

		    					var div2 = document.createElement("div");
		    					div2.id = "dingwei";
		    					liObj.appendChild(div2);		

		    					var aObj = document.createElement("a");
		    					var aObj_href = document.createAttribute("href");
		    					aObj_href.nodeValue = data[i].course_info;
		    					aObj.setAttributeNode(aObj_href);
		    					div2.appendChild(aObj);		

		    					var imgObj = document.createElement("img");
		    					imgObj.src = data[i].course_img;
		    					aObj.appendChild(imgObj);		

		    					var pObj1 = document.createElement("p");
		    					pObj1.id = "first_p";
		    					pObj1.innerHTML = data[i].course_name;
		    					liObj.appendChild(pObj1);
    				}

    			} else {
    				alert("未添加过课程，返回上一页"); 
					window.history.back(-1);
    			}
    		},
    	});

    }

    function getJsonObjLength(jsonObj) {
         var Length = 0;
          for (var item in jsonObj) {
              Length++;
          }
          return Length;
    }
</script>
</html>
