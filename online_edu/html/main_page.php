<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>鸿图教育</title>
        <style>
            * {
                padding: 0px;
                border: 0px;
                margin: 0px;
            }
            ul {
                overflow: hidden;
            }
            .slideBox {
                margin: 0px auto;
                width: 100%;
                height: 100%;
                border-radius: 20px;
                position: relative;
                overflow: hidden;
                cursor: pointer;
            }
            .slideBox ul {
                position: relative;
                width: 400%;
                height: 100%;
            }
            .slideBox ul li {
                float: left;
                width: 25%;
                height: 100%;
                position: relative;
            }
            .slideBox ul li img {
                width: 100%;
                height: 500px;
            }
            .spanBox {
                position: absolute;
                width: 230px;
                height: 20px;
                left: 140px;
                bottom: 0px;
            }
            .spanBox span {
                display: block;
                width: 50px;
                height: 18px;
                margin-left: 5px;
                background-color: rgba(201,178,207,1.00);
                float: left;
                line-height: 16px;
                text-align: center;
                font-family: cabin-sketch;
                font-size: 15px;
            }
            .slideBox .spanBox .active {
                background-color: rgba(155,83,244,0.79);
                border: solid 1px #BEEBEC;
                border-radius: 4px;
            }
            .prev {
                position: absolute;
                left: 30%;
                bottom: 10%;
                float: left;
                border-left: solid 1px rgba(251,245,246,1.00);
                opacity: 0.5;
                cursor: pointer;
            }
            .next {
                position: absolute;
                right: 30%;
                bottom: 10%;
                float: right;
                border-right: solid 1px rgba(245,237,237,1.00);
                opacity: 0.5;
                cursor: pointer;
            }
            .shadow{
                -webkit-box-shadow: #666 0px 0px 10px;
                -moz-box-shadow: #666 0px 0px 10px;
                box-shadow: #666 0px 0px 10px;
                background: #FFFFFF;
            }

            .box {
                width:100%;
                height:100%;
                text-align: center;
                line-height: 60px;
            }
            .container {
                width: 100%;
                margin:0;
            }
            .header {
                width:100%;
                height:15%;
                background-color: #66CCCC;
                position: absolute;
                top: 0;
            }
            .content {
                position: absolute;
                top: 15%;
                bottom: 0;
                width: 100%;
                height: 70%;    
                background-color: green;      
            }
            .footer {
                height:15%;
                width:100%;
                position: absolute;
                bottom: 0;
                background-color: #778899;
            }
            .left {
                height:100%;
                width:20%;
                float: left;
            }
            .center {
                float: left;
                width: 60%;
                height: 100%;
                background: blanchedalmond;
            }
            .right {
                height:100%;
                width:20%;
                float: right;               
            }
            .div_left {
                float: left;
                width: 200px;
            }
            .div_right {
                float: right;
                width: 200px;
            }
            .copyright {
                font-family: "宋体";
                color: #FFFFFF;
                text-align:center;
                line-height: 30px;
                margin-top: 10px;
            }
            #footer .copyright p {
                height: 18px;
                width: 100%;
            }

            a {
                line-height: 90px;
                font-size: 16px;
            }
            a:link {
                text-decoration: none;
            }
            a:hover {
                color: blue;
                text-decoration: underline;
            }
            .main_page {
                font-size: 30px;
                font-family: "微软雅黑";
            }
        </style>
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    </head>
    <body>
         <div class="container">            
             <div class="box">
                <div class="header">
                    <div class="div_left">
                        <a class="main_page" href="online_education.html">鸿图教育</a>
                    </div>
                    <div class="div_right">
                        <a href="" onclick="openMine()">我的中心</a>
                        <a href="login.html" >
                            <?php
                            session_start();
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            } else {
                                echo "请先登录";
                            }
                            ?>
                        </a> 
                    </div>
                </div>
                <div class="content">
                         <div class="left"></div>
                         <div class="center">
                             <div class="slideBox">
                                 <ul>
                                     <li><img src="../images/one.jpg" alt="" onclick="window.open('lesson1.html')" /></li>
                                     <li><img src="../images/two.jpg" alt="" /></li>
                                     <li><img src="../images/three.jpg" alt="" /></li>
                                     <li><img src="../images/four.jpg" alt="" /></li>
                                 </ul>
                                 <div class="spanBox">
                                    <span class="active">课程1</span>
                                    <span>课程2</span>
                                    <span>课程3</span>
                                    <span>课程4</span>
                                 </div>
                             </div>
                             <div class="prev shadow"><img src="../images/left_arrow.jpg" width="30" height="50" alt=""/></div>
                             <div class="next shadow"><img src="../images/right_arrow.jpg" width="30" height="50" alt=""/></div>
                         </div>
                         <div class="right"></div>
                </div>
                <div class="footer">
                    <div class="copyright">
                        <p>鸿图教育是鸿图旗下专注技能提升的在线教育平台</p>
                        <p>联系地址：</p>
                        <p>联系电话：</p>
                    </div>
                </div>
             </div>
         </div>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            var slideBox = $(".slideBox");
            var ul = slideBox.find("ul");
            var oneWidth = slideBox.find("ul li").eq(0).width();
            var number = slideBox.find(".spanBox span");           
            var timer = null;
            var sw = 0;     

            number.on("click",function() {
            $(this).addClass("active").siblings("span").removeClass("active");
            sw = $(this).index();
            ul.animate( {
                "right":oneWidth*sw,    
               });
            });

            $(".next").stop(true,true).click(function() {
                sw++;
                if(sw == number.length) {
                    sw = 0
                };
                number.eq(sw).trigger("click");
            });

            $(".prev").stop(true,true).click(function() {
                sw--;
                if(sw == number.length) {
                    sw = 0
                };
                number.eq(sw).trigger("click");
            });

            timer = setInterval(function() {
                sw++;
                if(sw == number.length) {
                    sw = 0
                };
                number.eq(sw).trigger("click");
            },4000);

            slideBox.hover(function() {
                $(".next,.prev").animate( {
                    "opacity":1,
                },200);
            clearInterval(timer);
            },function() {
                $(".next,.prev").animate( {
                    "opacity":0.5,
                },500);
            timer = setInterval(function() {
                sw++;
                if(sw == number.length) {
                    sw = 0
                };
                number.eq(sw).trigger("click");
            },4000);
            })
    
        })

        function openMine() {
            window.Location.href = "mine.php";
        }
    </script>
</html>
