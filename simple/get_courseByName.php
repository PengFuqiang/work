<?php
session_start();
include('conn.php');
$table = "t_online_education_course";
$table_my = "t_online_education_myCourse";
$phone = $_SESSION['phone'];
$course_name = '山东教师招聘笔试通关班五期';
//$course_name = $_POST['course_name'];

try{
        $sth = $dbh->prepare("SELECT * FROM $table WHERE course_name = '$course_name' ");
        $sth->execute(array(
        ));
        $items = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                array_push($items, $row);
        }
        $result = $items;

        $course_id = $result[0]['course_id'];
        $course_name = $result[0]['course_name'];
        echo($course_id);
        if ($result != null) {
            $sth = $dbh->prepare("INSERT INTO $table_my SET
                       	phone = :phone,
                        course_id = :course_id,
                        course_name = :course_name
                        ");
                $sth->execute(array(
                        ':phone' => $phone,
                        ':course_id' => $course_id,
                		':course_name' => $course_name
        ));
        }
}catch(PDOEXception $e){
        $result = array();
        $result['isError'] = $e->getMessage();
        echo json_encode($result);
        exit;
}
