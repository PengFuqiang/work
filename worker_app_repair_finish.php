<?php
session_start();
$table = 't_app_repair';
$id = $_POST['id'];
$phone = $_POST['phone'];
$problem_class = $_POST['problem_class'];
$worker = $_POST['worker'];
include '../conn.php';

try{

        $sth = $dbh->prepare("UPDATE $table SET
                finish = 1
                where id like '$id' ");
        $sth->execute();
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