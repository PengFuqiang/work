<?php
$table = "t_online_education_studentInfo";

include('conn.php');

$id = $_POST['stu_id'];
try{
    $sth = $dbh->prepare("delete from $table where id=$id");
    $sth->execute();
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}