<?php
session_start();
include('conn.php');
$table = "t_online_education_user";
$phone = $_POST['phone'];
$username = $_POST['username'];
$password = $_POST['password'];
$check_pwd = $_POST['check_pwd'];

if (is_phone($phone) == false) {
    exit('请输入正确手机号码！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

if (is_username($username) == false) {
    exit('请检查用户名的格式！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

if (is_password($password) == false) {
    exit('请输入密码的格式！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

if($password != $check_pwd) {
    exit('请确认两次密码相同！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

//检测用户名及密码是否正确
$sth = $dbh->prepare("SELECT * FROM $table WHERE phone = :phone");
$sth->execute(array(
        ':phone' => $_POST['phone']
));
$result = $sth->fetch(PDO::FETCH_ASSOC);

if($result){
        exit('改手机号已注册！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}else{
        
        $sth = $dbh->prepare("INSERT INTO $table set phone = :phone,password = :password,username = :username");
        $sth->execute(array(
            ':phone' => $_POST['phone'],
            ':password' => $_POST['password'],
            ':username' => $_POST['username']
        ));
        $_SESSION['username']=$username;
        $_SESSION['phone']=$phone;
        header("Location:index.php");
        exit();
}

function is_phone($phone) {
    if (preg_match("/1[34578]{1}\d{9}$/", $phone)) {
        return true;
    } else {
        return false;
    }
}

function is_username($username) {
    if (strlen($username) < 3 || strlen($username) > 11) {
        return false;
    } else if (preg_match("/^[A-Za-z0-9_\x{4e00}-\x{9fa5}]+$/u", $username)) {
        return true;
    } else {
        return false;
    }
}

function is_password($password) {
    if (strlen($password) < 6 || strlen($password) > 16) {
        return false;
    } else if (preg_match("/^[0-9a-zA-Z]{6,16}$/", $password)) {
        return true;
    } else {
        return false;
    }
}
