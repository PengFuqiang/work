<!doctype html>
<html lang="en">
<head id="header" name="header">
	<title>加中国际教育</title>
	<script src="js/index.js"></script>
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
					<a href="denglu.html"><li>我的课程</li></a>
					<a href="photo.html"><li>图书专栏</li></a>
					<a href="app.html"><li>APP下载</li></a>
				</ul>
			</div>
			<div id="denglu">
					<?php
                        session_start();
                        if (isset($_SESSION['phone']) && !empty($_SESSION['phone'])) {
                    ?>
                    	<a href="tuichu.php?action=logout">退出</a>
                    	<a href="">欢迎你！</a>
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
					<li style="background:#D42A3C;color:#FFF;"><a href="#" style="color:#FFF;">推荐</a></li>
					<li><a href="#">免费</a></li>
					<li><a href="#">全部</a></li>
				</ul>
			</div>
			<!--轮播下面导航条结束-->
		</div>
		<!--页面轮播部分：包括form表单、轮播图部分结束-->
		
		<!--==========================================-->
		
		<!--页面主题部分开始-->
		<div id="section">
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/1.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">开课时间:2016-02-15</p>
							<a href="#"><b>￥149.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/2.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥9.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/3.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥29.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/4.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥5.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/5.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥0.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/6.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥129.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/7.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥99.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/8.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥599.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/9.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥5.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/10.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥0.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/11.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥0.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/12.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥0.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/13.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥9.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/14.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥9.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/15.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥69.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/16.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥29.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/17.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥9.00</b></a>
						</li>
					</ul>
				</div>
				<div class="alldiv">
					<ul id="alldiv_ul">
						<li>
							<div id="dingwei">
								<a href="#"><img src="images/allimgs/18.jpg" alt=""></a>
								<div id="dingwei_child">限售1000本，已售800本。</div>
							</div>
							<p id="first_p">山东教师招聘笔试通关班五期</p>
							<p id="last_p">&nbsp;开课时间:2016-02-15</p>
							<a href="#"><b>￥799.00</b></a>
						</li>
					</ul>
				</div>
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
</html>