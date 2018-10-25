<?php
$table = "t_purchase";

include '../../conn.php';

$row = $_REQUEST['row'];
$id = $row['id'];
try{
    $sth = $dbh->prepare("delete from $table where id=$id");
    $sth->execute();
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}