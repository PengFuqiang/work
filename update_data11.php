<?php

session_start();
$table_purchase = 't_purchase_all';
$id = intval($_REQUEST['id']);
$pass_if = $_POST['pass_if'];
include '../../conn.php';
try{

    if($pass_if == '否')
        $budget_range = 2;
    else if($budget_range == '是')
        $budget_range = 3;
    else
        $budget_range = 0;
    
    $sth_purchase = $dbh->prepare("update $table_purchase set
      pass_if=:pass_if where id = $id
    ");
    $sth_purchase->execute(array(
        ':pass_if'=>$pass_if
    ));

    $sth_purchase = $dbh->prepare("update $table_purchase set
      budget_range=:budget_range where id = $id
    ");
    $sth_purchase->execute(array(
        ':budget_range'=>$budget_range
    ));
}catch (PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}