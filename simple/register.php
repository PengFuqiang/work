<?php
session_start();
$table = "t_online_education_user";
$password = $_POST['password'];
$phone = $_POST['phone'];

include('conn.php');

//检测手机号是否存在
$rows = mysql_query("SELECT * FROM $table WHERE phone = '$phone' ;");
if (mysql_num_rows($rows) < 1) {
    $result = mysql_query("INSERT INTO $table VALUES('password','$phone')");
    if ($result) {
        echo "注册成功！";
        $_SESSION['phone'] = $phone;
        header("Location:index.php");
        exit();
    } else {
    	echo "注册失败！";
    }
} else {
    exit('手机号码已注册！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

