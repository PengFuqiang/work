<?php
session_start();
include('conn.php');
$table = "t_online_education_myCourse";
$course_name = $_POST['course_name'];

try{
	$sth = $dbh->prepare("DELETE FROM $table WHERE course_name = :course_name ");
	$sth->execute(array(
                ':course_name' => $_POST['course_name']
        ));
}catch(PDOEXception $e){
        $result = array();
        $result['isError'] = $e->getMessage();
        echo json_encode($result);
        exit;
}