<?php
session_start();
include('conn.php');
$table = "t_online_education_myCourse";
$phone = $_SESSION['phone'];

try{
	$sth = $dbh->prepare("SELECT course_name FROM $table WHERE phone = :phone ");
	$sth->execute(array(
                ':phone' => $_SESSION['phone']
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