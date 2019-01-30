<?php
session_start();
include('conn.php');
$table = "t_online_education_myCourse";
$phone = $_SESSION['phone'];
$course_id = $_POST['course_id'];
$course_name = $_POST['course_name'];

try{
	$sth = $dbh->prepare("INSERT INTO $table SET 
		phone = :phone,
		course_id = :course_id,
		course_name = :course_name
		 ");
	$sth->execute(array(
				':phone' => $_SESSION['phone'],
				':course_id' => $_POST['course_id'],
                ':course_name' => $_POST['course_name']
                
        ));
}catch(PDOEXception $e){
        $result = array();
        $result['isError'] = $e->getMessage();
        echo json_encode($result);
        exit;
}