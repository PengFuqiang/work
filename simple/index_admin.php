<!doctype html>
<html lang="en">
<head id="header" name="header">
	<title>加中国际教育</title>
	<link rel="stylesheet" href="css/index_admin.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<meta charset="utf-8">
	<style type="text/css">
		#admin {
        	margin: 0;
        	padding: 0;
        	background-color: #F3F3F3;
        	font-family: '汉仪大隶书繁';
        }        

        form {
        	max-width: 640px;
        	width: 100%;
        	margin: 24px auto;
        	font-size: 18px;
        }        

        label {
        	display: block;
        	margin: 10px 10px 15px;
        	font-size: 16px;
        }        

        input {
        	display: block;
        	width: 100%;
        	height: 40px;
        	font-size: 16px;
        	margin-top: 10px;
        	padding: 6px 10px;
        	color: #333;
        	border: 1px solid #CCC;
        	box-sizing: border-box;
        }        

        textarea {
        	display: block;
        	width: 100%;
        	height: 120px;
        	font-size: 16px;
        	margin-top: 10px;
        	padding: 6px 10px;
        	color: #333;
        	border: 1px solid #CCC;
        	box-sizing: border-box;
        } 
      

        .btn {
        	margin-top: 30px;
        }        

        .btn input {
        	color: #FFF;
        	background-color: green;
        	border: 0 none;
        	outline: none;
        	cursor: pointer;
        }

        .half {
            width: 25%;
            float: left;
            position: relative
        }

        .half > a {
            position: relative;
            width: 8rem;
            display: inline-block;
            background: #18b4ed;
            height: 8rem;
            left: 50%;
            margin-left: -4rem
        }        

        .half > a  img {
            width: 5rem;
            height: 4.16rem;
            margin-left: 1.5rem;
            margin-top: 1.92rem
        }        

        .half > p {
            font-size: 1.5rem;
            text-align: center;
            position: relative;
            bottom: 0;
            margin-top: 1.2rem;
            color: #999;
        }
        .filename {
		    position: absolute;
		    outline: 0 none;
		    line-height: 1.5rem;
		    font-size: 1.5rem;
		    width: 100%;
		    margin: 0;
		    overflow: hidden;
		    cursor: default;
		    text-overflow: ellipsis;
		    white-space: nowrap;
		    border: 0;
		    top: 9.2rem;
		    text-align: center;		

		}
        .uploader {
            position: absolute;
        	width: 54%;
            height: 8rem;
            left: 23%;
            cursor: default;
            height: 100%;
            float: left;
        }
        .uploader input[type=file] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    bottom: 0;
		    border: 0;
		    padding: 0;
		    margin: 0;
		    height:8rem;
		    width: 100%;
		    cursor: pointer;
		   border: solid 1px #ddd;
		    opacity: 0;
		}
        .license{
            position: relative;
            width: 8rem;
            display: inline-block;
            background: #18b4ed;
            height: 8rem;
            left: 50%;
            margin-left: -4rem
        }
        .license >img{
            width: 5rem;
            height: 4.16rem;
            margin-left: 1.5rem;
            margin-top: 1.92rem
        }
        .yulan{
		    position: fixed;
		    width: 100%;
		    height: 100%;
		    display: none;
		    top: 0;
		    left: 0;
		    text-align: center;
		    line-height: 100%;
		    background: #000;
		    z-index: 99999999;		

		}
		.yulan #img0{
		    display: inline-block;
		    max-width: 90%;
		    line-height: 100%;
		    max-height: 90%;
		    top: 40%; left: 50%;
		    -webkit-transform: translate(-50%, -40%);
		    position: absolute;
		}
		.enter{
		    position: absolute;
		    height: 10%;
		    bottom: 0;
		    left: 0;
		    width: 100%;
		    background: #fff;		

		}
		.enter .btn-2,.enter .btn-3{
			border: 0;
		    outline: none;
		    background: #18b4ed;
		    color: #fff;
		    height: 100%;
		    width: 8rem;
		    font-size: 2rem;
		}
	</style>
</head>
<body>
	<!--页面的全部部分-->
	<div id="container">
		<!--页面的头部：logo、导航..-->
		<div id="header">
			<div id="logo">
				<a href="index_admin.php"><img src="images/allimgs/logo1.png" alt=""></a>
			</div>
			<div id="nav">
				<ul>
					<a href="table_stu.php"><li>学生信息表</li></a>
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

		
		<!--页面主题部分开始-->
		<div id="section">

			<div class="half">
        		<div class="uploader blue">
        			<input type="text" class="filename" value="学生照片"  readonly/>
            		<a class="license">
                		<img id="img-1" src="images/logo_n.png"/>
            		</a>
            		<input id="file0" class="file-3" type="file" size="30" onchange="javascript:setImagePreview();" accept="image/*" capture="camera" />
        		</div>
        	<div class="yulan">
            	<img src="" id="img0" >
            		<div class="enter">
                		<button class="btn-2 fl">取消</button>
                		<button class="btn-3 fr">确定</button>
            		</div>
        	</div>
       		<!-- <p>营业执照</p>-->
    		</div>
			<div id="admin" >
				<form id="studentInfo" action="studentInfo.php" method="POST">
            		<fieldset>
<!--             			<h1 class="user">学生档案</h1> -->
            			<label id="" for="">
            				学生姓名: <input id="name" name="name" type="text" required autofocus placeholder="请输入姓名">
            			</label>
            			<label id="" for="">
            				电话: <input id="phone1" name="phone1" type="tel" required autofocus pattern="1\d{10}" placeholder="请输入手机号码">
            			</label>
            			<label id="" for="">
            				父亲: <input id="father" name="father" type="text" required autofocus placeholder="请输入姓名">
            			</label>
            			<label id="" for="">
            				电话: <input id="phone2" name="phone2" type="tel" required autofocus pattern="1\d{10}" placeholder="请输入手机号码">
            			</label>
            			<label id="" for="">
            				母亲: <input id="mother" name="mother" type="text" required autofocus placeholder="请输入姓名">
            			</label>
            			<label id="" for="">
            				电话: <input id="phone3" name="phone3" type="tel" required autofocus pattern="1\d{10}" placeholder="请输入手机号码">
            			</label>
            			<label for="">
            				生日: <input id="birthday" name="birthday" type="date" value="1999-01-01">
            			</label>
            			<label id="" for="">
            				家庭住址: <input id="address" name="address" type="text" required autofocus placeholder="请输入住址">
            			</label>
            			<label id="" for="">
            				邮箱地址: <input id="email" name="email" type="email" required autofocus placeholder="请输入邮箱地址">
            			</label>
            			
            			<label id="" for="">
            				入学时间: <input id="joinTime" name="joinTime" type="date" required autofocus value="2019-01-01">
            			</label>
            			<label id="" for="">
            				学籍类别: <input id="schoolRollType" name="schoolRollType" required autofocus type="text" placeholder="请输入学籍类别">
            			</label>
            			<label id="" for="">
            				自我介绍: <textarea id="introduction" name="introduction" type="text" placeholder="请输入自我介绍"></textarea> 
            			</label>
            			<label id="" for="">
            				原学籍: <input id="oldSchoolRoll" name="oldSchoolRoll" type="text" placeholder="请输入原学籍">
            			</label>
            			<label id="" for="" class="btn">
            				<input type="submit" value="保存">
            			</label>
            		</fieldset>
            	</form>
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
<script type="text/javascript">

</script>
<script type="text/javascript">
    function setImagePreview() {
        var preview, img_txt, localImag, file_head = document.getElementById("file_head"),
                picture = file_head.value;
        if (!picture.match(/.jpg|.gif|.png|.bmp/i)) return alert("您上传的图片格式不正确，请重新选择！"),
                !1;
        if (preview = document.getElementById("preview"), file_head.files && file_head.files[0]) preview.style.display = "block",
                preview.style.width = "63px",
                preview.style.height = "63px",
                preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);
        else {
            file_head.select(),
                    file_head.blur(),
                    img_txt = document.selection.createRange().text,
                    localImag = document.getElementById("localImag"),
                    localImag.style.width = "63px",
                    localImag.style.height = "63px";
            try {
                localImag.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)",
                        localImag.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = img_txt
            } catch(f) {
                return alert("您上传的图片格式不正确，请重新选择！"),
                        !1
            }
            preview.style.display = "none",
                    document.selection.empty()
        }
        return document.getElementById("DivUp").style.display = "block",
                !0
    }
</script>

<script>
    $("#file0").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
         obUrl = objUrl;
        console.log("objUrl = "+objUrl) ;
        if (objUrl) {
            $("#img0").attr("src", objUrl).show();
        }
        else{
            $("#img0").hide();
        }
    }) ;
   function qd(){
       var objUrl = getObjectURL(this.files[0]) ;
       obUrl = objUrl;
       console.log("objUrl = "+objUrl) ;
       if (objUrl) {
           $("#img0").attr("src", objUrl).show();
       }
       else{
           $("#img0").hide();
       }
   }
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
</script>
</html>