<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>加中国际教育</title>
    <link rel="stylesheet" href="css/app1.css">
    <link rel="stylesheet" href="css/scrollbar.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/tab.js"></script>
    <script type="text/javascript" src="js/contentslider.js"></script>
    <script type="text/javascript" src="js/jquery.scroll.js"></script>
    <script type="text/javascript" src="js/scroll.js"></script>
    <script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="js/switch.js"></script>
    
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

        <!--页面主题部分开始-->
        <div class="background-gradient">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="#">课程</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="padding"><h4 id="course_name">山东教师招聘笔试通关班五期</h4></div>
                </div>
                <div class="row row-nav-margin">
                    <div class="col-xs-12 col-md-6">
                        <a href="#" id="join_btn" class="pull-right button-self" "></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div id="banner">
            <div id="slider2" class="leftsecbanner">
            <div class="contentdiv">
                <object width="940" align="middle" height="507" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
                    <param value="http://player.youku.com/player.php/sid/XNTk5MjcxODk2/v.swf" name="movie">
                    <param value="high" name="quality">
                    <param value="always" name="allowScriptAccess">
                    <param value="internal" name="allowNetworking">
                    <param value="true" name="allowfullscreen">
                    <param value="transparent" name="wmode">
                    <embed width="940" height="507" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" allownetworking="internal" allowscriptaccess="always" allowfullscreen="true" quality="high" src="http://player.youku.com/player.php/sid/XNTk5MjcxODk2/v.swf">
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0s">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/pa14VNsdSYM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/Jx2yQejrrUE?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/yd8jh9QYfEs?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/e82VE8UtW8A?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/X9_n8jakvWU?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            <div class="contentdiv">
                <object type="application/x-shockwave-flash" style="width:940px; height:507px;" data="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0">
                    <param name="movie" value="http://www.cssmoban.com/?v/o8PtBtRzcqM?fs=1&amp;hl=en_US&amp;rel=0" />
                    <param value="application/x-shockwave-flash" name="type" /> 
                    <param value="true" name="allowfullscreen" /> 
                    <param value="always" name="allowscriptaccess" /> 
                    <param value="opaque" name="wmode" />
                </object>
            </div>
            </div>
            <div id="paginate-slider2">
            <div class="usual">
                <div id="idTab1" class="tabssection">
                    <div class="css-scrollbar simple">
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small6.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时1 - PHP简介</span>
                                <span class="time">10分钟</span>
                                <span class="channel">RihannaVEVO</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small2.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时2 - PHP安装</span>
                                <span class="time">11分钟</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small3.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时3 - PHP语法</span>
                                <span class="time">15分钟</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small4.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时4 - PHP变量</span>
                                <span class="time">XX</span>
                                <span class="channel">RihannaVEVO</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small5.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时5 - 数据类型</span>
                                <span class="time">XXX</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small6.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时6 - 常量</span>
                                <span class="time">XXX</span>
                                <span class="channel">RihannaVEVO</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small2.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时7 - 字符串</span>
                                <span class="time">XXX</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small3.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时8 - 运算符</span>
                                <span class="time">XXX</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small4.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时9 - 数组</span>
                                <span class="time">XXX</span>
                                <span class="channel">RihannaVEVO</span>
                            </span>
                        </a>
                        <a href="#" class="toc">
                            <!-- <span class="thumb"><img src="images/appimgs/video_small5.gif" alt="" /></span> -->
                            <span class="desc">
                                <span class="title">课时10 - 数组排序</span>
                                <span class="time">XXX</span>
                                <span class="channel">Enrique Iglesias</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            </div>
            <script type="text/javascript" src="js/banner.js"></script>
        </div>
        <div id="course_intro" class="aui-tab" data-ydui-tab>
            <ul class="tab-nav">
                <li class="tab-nav-item tab-active">
                    <a href="javascript:;">
                        <span>课程介绍</span>
                    </a>
                </li>
                <li class="tab-nav-item">
                    <a href="javascript:;">
                        <span>内容列表(6)</span>
                    </a>
                </li>
                <li class="tab-nav-item">
                    <a href="javascript:;">
                        <span>讨论(1)</span>
                    </a>
                </li>
            </ul>
            <div class="tab-panel">
                <div class="tab-panel-item tab-active">
                    <div class="aui-course-head">
                        <p>Hi 大家好，我是Lucas</p>
                        <p>今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！一起来看看吧！</p>
                        <p>如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</p>
                        <p>我们的简历究竟如何才能一秒爪式面试官的眼球。</p>
                        <p>今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！一起来看看吧！</p>
                        <p>如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</p>
                        <p>我们的简历究竟如何才能一秒爪式面试官的眼球。</p>

                    </div>
                </div>
                <div class="tab-panel-item">
                    <div class="aui-course-catalog">
                        <h3>课时1：PHP简介</h3>
                        <ul>
                            <li>1、如果简历是我们发给Hr的第一份简历</li>
                            <li>2、我们的简历究竟如何才能一秒爪式面试官的眼球该站在什么样的角度来思考</li>
                            <li>3、如何做好一份合格的简历呐！一起来看看吧！</li>
                            <li>4、该站在什么样的角度来思考，精心打磨的13节课堂</li>
                            <li>5、如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</li>
                            <li>6、今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！</li>
                            <li>7、如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</li>
                        </ul>
                        <h3>第二章:简历给HR带来的第一印象</h3>
                        <ul>
                            <li>1、如果简历是我们发给Hr的第一份简历</li>
                            <li>2、我们的简历究竟如何才能一秒爪式面试官的眼球该站在什么样的角度来思考</li>
                            <li>3、如何做好一份合格的简历呐！一起来看看吧！</li>
                            <li>4、该站在什么样的角度来思考，精心打磨的13节课堂</li>
                            <li>5、如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</li>
                            <li>6、今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！</li>
                            <li>7、如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</li>
                        </ul>
                    </div>
                </div>
                <div class="tab-panel-item">
                    <div class="aui-course-head">
                        <p>金融简历怎么做？</p>
                        <p>今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！一起来看看吧！</p>
                        <p>如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</p>
                        <p>我们的简历究竟如何才能一秒爪式面试官的眼球。</p>
                        <p>今天我要分享的事情是简历你不知道的那些事情，如何做好一份合格的简历呐！一起来看看吧！</p>
                        <p>如果简历是我们发给Hr的第一份简历，该站在什么样的角度来思考</p>
                        <p>我们的简历究竟如何才能一秒爪式面试官的眼球。</p>
                    </div>
                </div>
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
        </div>
        <!--页面底部结束-->
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function () {
        loadStatus();
    });

    function loadStatus() {
        var course_name = $("#course_name").html();
        $.ajax({
            type: 'GET',
            url: 'check_course.php',
            dataType: 'json',
            data: {
                course_name: 'course_name'
            },
            success: function(data) {
                if (data) {
                    var data_length = getJsonObjLength(data);
                    var name_list = new Array();
                    for (var i = 0; i < data_length; i++) {
                        name_list.push(data[i].course_name);
                    }
                    if (name_list.includes(course_name)) {
                        $("#join_btn").text('已加入，点此取消');
                        $("#join_btn").attr("onclick","cancle_study();");
                    } else if (!name_list.includes(course_name) && !name_list) {
                        $("#join_btn").text('加入我的学习');
                        $("#join_btn").attr("onclick","join_study();");
                    } else {
                        $("#join_btn").text('加入我的学习');
                        $("#join_btn").attr("href","denglu.php");
                    }
                } 
            }
        })
    }
    function cancle_study() {
        var course_name = $("#course_name").html();
        $.ajax({
            type: 'POST',
            url: 'cancle_study.php',
            data: {
                "course_name": course_name
            },
        });
        loadStatus();
    }

    function join_study() {
        var course_name = $("#course_name").html();
        $.ajax({
            url: "get_courseByName.php",
            type: "POST",
            data: {
                "course_name": course_name
            },
            success: function(data) {//ajax请求成功后触发的方法
        },
        error: function(msg) {//ajax请求失败后触发的方法
            alert(msg); //弹出错误信息
        }
        });
        loadStatus();
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