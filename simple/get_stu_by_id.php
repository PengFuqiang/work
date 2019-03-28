<?php
session_start();

$table = "t_online_education_studentInfo";

$id = $_GET['stu_id'];

include('conn.php');

try{
        $sth = $dbh->prepare("select count(*) from $table where
            id=$id");
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $result = array();
        $result['total'] = $row['count(*)'];

        $sth = $dbh->prepare("select * from $table where id=$id");
        $sth->execute(); 
        $items = array();  
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                array_push($items, $row);
        }
        $result['rows'] = $items;
 
}catch (PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result); 
    exit;
}   
echo json_encode($result);
