<?php
session_start();

$table = "t_paybill_insert";

include '../conn.php';

$room_id = $_POST['room_id'];
$month_bill = $_POST['month_bill'];
$type = $_POST['type'];
$zengsong = $_POST['zengsong'];
$bill_pay = $_POST['bill_pay'];
$discount = $_POST['discount'];
$time_begin = $_POST['time_begin'];
$time_end = $_POST['time_end'];

try{
        $sth = $dbh->prepare("INSERT INTO $table (room_id,month_bill,type,zengsong,bill_pay,discount,time_begin,time_end) 
            VALUES ('$room_id','$month_bill','$type','$zengsong','$bill_pay','$discount','$time_begin','$time_end')");
        $sth->execute(array(
        ));
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}