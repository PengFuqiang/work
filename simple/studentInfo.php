<?php
session_start();
include('conn.php');
$table = "t_online_education_studentInfo";
$name = $_POST['name'];
$phone1 = $_POST['phone1'];
$father = $_POST['father'];
$phone2 = $_POST['phone2'];
$mother = $_POST['mother'];
$phone3 = $_POST['phone3'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];
$email = $_POST['email'];
$joinTime = $_POST['joinTime'];
$schoolRollType = $_POST['schoolRollType'];
$introduction = $_POST['introduction'];
$oldSchoolRoll = $_POST['oldSchoolRoll'];


try{
        $sth = $dbh->prepare("INSERT INTO $table (
        	name,
        	phone1,
        	father,
        	phone2,
        	mother,
        	phone3,
        	birthday,
        	address,
        	email,
        	joinTime,
        	schoolRollType,
        	introduction,
        	oldSchoolRoll
        	) 
            VALUES (
            '$name',
            '$phone1',
            '$father',
            '$phone2',
            '$mother',
            '$phone3',
            '$birthday',
            '$address',
            '$email',
            '$joinTime',
            '$schoolRollType',
            '$introduction',
            '$oldSchoolRoll'
        )
        ");
        $sth->execute(array(
        ));
        echo "<script>alert('信息录入成功');</script>";
        header("refresh:0;url=index_admin.php");
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}
