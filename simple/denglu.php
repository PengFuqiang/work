<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>加中国际教育</title>
	<link rel="stylesheet" href="css/denglu.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script src="js/denglu.js"></script>
	
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
					<a href="#"><li>我的课程</li><a/>
					<a href="photo.php"><li>图书专栏</li></a>
					<a href="app.php"><li>课程详情</li></a>
				</ul>
			</div>
			<div id="denglu">
				<a href="zhuce.php">注册</a>
				<a href="denglu.php">登录</a>
			</div>
		</div>
		

		<!--登陆页面表单部分开始-->
		<div class="content_box">
			<div class="box_shadow">
				<h1 class="user">用户登录</h1>
				<div class="form_div">
					<form id="form_login" action="login.php" method="post">
						<input type="text" id="phone" name="phone" placeholder="用户手机号码">
						<input type="password" value="" id="password" name="password" autocomplete="new-password" placeholder="用户密码">
						<input class="input_button" style="background: #ff6100;color:#fff;cursor: pointer;" type="submit" name="submit" value='立即登录' />
						<p><a href="denglu_admin.php">管理员登录 > ></a></p>
						<p><a href="zhuce.php">没有账号？点此注册</a></p>
					</form>
				</div>
			</div>
		</div>
		<!--登陆页面表单部分结束-->
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
</html>
