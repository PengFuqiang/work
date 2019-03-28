<!doctype html>
<html lang="en">
<head id="header" name="header">
	<title>加中国际教育</title>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/index.css">
	<meta charset="utf-8">
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
					<?php
						session_start();
						if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
					?>
						<a href="my.php"><li>我的课程</li></a>
					<?php
						} else {
					?>
						<a href="denglu.php"><li>我的课程</li></a>
					<?php
						}
					?>
					
					<a href="photo.php"><li>图书专栏</li></a>
					<a href="app.php"><li>课程详情</li></a>
				</ul>
			</div>
			<div id="denglu">
					<?php
                        session_start();
                        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                    ?>
                    	<a href="tuichu.php?action=logout">退出</a>
                    	<a href="">欢迎：<?php echo $_SESSION['username'];?></a>
                    <?php
                    	} else {
                    ?>
                    	<a href="zhuce.php">注册</a>
                    	<a href="denglu.php">登录</a>
                    <?php
                    	}
                    ?>
			</div>
		</div>
		<!--页面轮播部分：包括form表单、轮播图部分开始-->
		<div id="banner">
			<div id="form_left">
				<!--轮播部分开始-->
				<div id="banner_ppt">
					<ul id="ppt">
						<img src="images/allimgs/1452329274.jpg" alt="">
						<img src="images/allimgs/1452510331.jpg" alt="">
						<img src="images/allimgs/1451571480.png" alt="">
					</ul>
				</div>
				<!--轮播部分结束-->
				<!--轮播右边三张小兔开始-->
				<div id="photo_three">
					<a href="#"><img src="images/allimgs/1452329274.jpg" alt=""></a>
					<a href="#"><img src="images/allimgs/1452510331.jpg" alt=""></a>
					<a href="#"><img src="images/allimgs/1451571480.png" alt=""></a>
				</div>
				<!--轮播右边三张小兔结束-->
			</div>
			<!--form表单部分结束-->
				
			<!--轮播下面导航条开始-->
			<div id="banner_nav">
				<ul id="banner_ul">
					<li><a href="index.php">推荐</a></li>
					<li><a href="#">免费</a></li>
					<li style="background:#D42A3C;color:#FFF;"><a href="all_course.php" style="color:#FFF;">全部</a></li>
				</ul>
			</div>
			<!--轮播下面导航条结束-->
		</div>
		<!--页面轮播部分：包括form表单、轮播图部分结束-->
		
		<!--==========================================-->
		
		<!--页面主题部分开始-->
		<div id="section">
		</div>
		<!--页面主题部分结束-->
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
			<!--回到顶部图标开始-->
			<div class="backTop">
				<a href=""><img src="images/allimgs/backtop.png" alt=""></a>
				<a href=""><p>置顶</p></a>
			</div>
			<!--回到顶部图标结束-->
		</div>
		<!--页面底部结束-->
	</div>
	
</body>
<script type="text/javascript">
	$(document).ready(function () {
        loadCourse();
    });

    function loadCourse() {
    	$.ajax({
    		type: 'get',
    		url: 'get_all_course.php',
    		dataType: 'json',
    		data: {
    			course_id: 'course_id',
    			course_name: 'course_name',
    			course_img: 'course_img',
    			course_info: 'course_info'
    		},
    		success: function(data) {
    			if (data) {
    				var course_length = getJsonObjLength(data);
    				for (var i = 0; i < course_length; i++) {
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
    			}
    		}
    	})
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