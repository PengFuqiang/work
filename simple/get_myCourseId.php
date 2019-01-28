<?php
session_start();
include('conn.php');
$table1 = "t_online_education_myCourse";
$table2 = "t_online_education_course";
$phone = $_SESSION['phone'];

try{
		$sth = $dbh->prepare("SELECT * FROM $table2 WHERE $table2.course_id IN (SELECT $table1.course_id FROM $table1 WHERE phone = :phone) ");
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