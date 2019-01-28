<?php
session_start();
include('conn.php');
$table = "t_online_education_user";
$phone = $_POST['phone'];
$password = $_POST['password'];

//检测用户名及密码是否正确
$sth = $dbh->prepare("SELECT * FROM $table WHERE phone = :phone AND password = :password LIMIT 1");
$sth->execute(array(
        ':phone' => $_POST['phone'],
        ':password' => $_POST['password']
));
$result = $sth->fetch(PDO::FETCH_ASSOC);
print_r($result);

if($result){
        $_SESSION['username']=$result['username'];
        $_SESSION['phone']=$result['phone'];
        header("Location:index.php");
        exit();
}else{
        exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}