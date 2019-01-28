<?php
session_start();
include('conn.php');
$table = "t_online_education_course";
$course_id = $_POST['course_id'];

try{
	$sth = $dbh->prepare("SELECT * FROM $table WHERE course_id = :course_id ");
	$sth->execute(array(
                ':course_id' => $_POST['course_id']
        ));
        $items = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                array_push($items, $row);
        }
        $result = $items;
}catch(PDOEXception $e){
        $result = array();
        $result['isError'] = $e->getMessage();
        echo json_encode($result);
        exit;
}
echo json_encode($result);