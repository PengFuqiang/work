<?php

session_start();
$table_purchase = 't_purchase_all';
$id = intval($_REQUEST['id']);
$pass_if = $_POST['pass_if'];
include '../../conn.php';
try{

    if($pass_if == '否')
        $pass_if = 2;
    else if($pass_if == '是')
        $pass_if = 3;
    else
        $pass_if = 0;
    $sth_purchase = $dbh->prepare("update $table_purchase set
      budget_range=:budget_range where id = $id
    ");
    $sth_purchase->execute(array(
        ':budget_range'=>$pass_if
    ));
}catch (PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}