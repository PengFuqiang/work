<?php
session_start();
include('conn.php');
$table = "t_online_education_user";
$phone = $_POST['phone'];
$password = $_POST['password'];
$check_pwd = $_POST['check_pwd'];

if (is_phone($phone) == false) {
    exit('请输入正确手机号码！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}

if(strlen($password)<6 || strlen($password)>16) {
    exit('密码长度不合规定！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
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
        
        $sth = $dbh->prepare("INSERT INTO $table set phone = :phone,password = :password");
        $sth->execute(array(
            ':phone' => $_POST['phone'],
            ':password' => $_POST['password']
        ));
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
