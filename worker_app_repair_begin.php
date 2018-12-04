<?php
$table = 't_app_repair';
$phone = $_POST['phone'];
$problem_class = $_POST['problem_class'];
include '../conn.php';

try{
        $sth = $dbh->prepare("update $table set start = 1
                where phone like '$phone' and problem_class like 'problem_class' ");
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