<?php
session_start();
if ($_GET['action'] == "logout") {
	unset($_SESSION['phone']);
	unset($_SESSION['password']);
	unset($_SESSION['username']);
	echo '注销登录成功！点击此处<a href="index.php">回到主页</a>';
}