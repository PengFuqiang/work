<?php
$table = 't_app_repair';
$phone = $_POST['phone'];
$problem_class = $_POST['problem_class'];
$worker = $_POST['worker'];
include '../conn.php';

try{
        $sth = $dbh->prepare("UPDATE $table SET 
                start = 1,
                worker=:worker
                where phone like '$phone' and problem_class like '$problem_class' ");
        $sth->execute(array(
                ':worker' => $worker
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