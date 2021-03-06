<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>加中国际教育</title>
	<link rel="stylesheet" href="css/photo.css">
	<script src="js/photo.js"></script>
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

		<!--中间内容部分开始-->
		<div class="content">
			<!--轮播部分开始-->
			<div class="banner">
				<div id="banner_ppt">
					<ul id="ppt">
						<img src="images/photoimgs/1.jpg" alt="">
						<img src="images/photoimgs/2.jpg" alt="">
						<img src="images/photoimgs/3.png" alt="">
						<img src="images/photoimgs/4.jpg" alt="">
					</ul>
				</div>
			</div>
			<!--轮播部分结束-->
			<!--下部教材展示部分开始-->
			<div class="books">
				<div class="books_one">
					<img src="images/photoimgs/11.png" alt="">
					<p>国家教师资格证专用教材</p>
				</div>
				<div class="books_two">
					<img src="images/photoimgs/22.jpg" alt="">
					<p>统考教学基础知识+真题+预测试卷</p>
				</div>
			</div>
			<!--下部教材展示部分结束-->
		</div>
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