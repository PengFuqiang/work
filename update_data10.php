<?php
session_start();
$table_purchase = "t_purchase_all";
$table_supplier = "t_supplier_all";

include '../../conn.php';

$id = intval($_REQUEST['id']);
$time=$_POST['time'];
$abstract = $_POST['abstract'];
$project = $_POST['project'];
$project_detail = $_POST['project_detail'];
$product_name = $_POST['product_name'];
$standard = $_POST['standard'];
$type_number = $_POST['type_number'];
$unit = $_POST['unit'];
$budget_number = $_POST['budget_number'];
$purchase_number = $_POST['purchase_number'];
$purchase_unit_price = $_POST['purchase_unit_price'];
$purchase_money=$purchase_unit_price * $purchase_number;//采购金额
$budget_note = $_POST['budget_note'];
$Un_purchase_number = $budget_number - $purchase_number;//未采购数量
$supplier = $_POST['supplier'];
//$level = get_level($_POST['level']);
$approve_number = $_POST['approve_number'];
$pay_number = $_POST['pay_number'];
$pay_money=$_POST['pay_money'];
$pay_should = $purchase_money - $pay_money;//应付款金额
$visa_if = get_if($_POST['visa_if']);
$get_bill_if = get_if($_POST['get_bill_if']);
$got_bill = $_POST['got_bill'];
$receipt_responsible = $_POST['receipt_responsible'];
$invoice_money = $_POST['invoice_money'];
$note = $_POST['note'];
$userid = $_SESSION['userid'];

try{
    //根据purchase的id查询product的id
    $sth_purchase = $dbh->prepare("select * from $table_purchase where id = {$id}");
    $sth_purchase->execute();
    $row_purchase = $sth_purchase->fetch(PDO::FETCH_ASSOC);

    $sth = $dbh->prepare("UPDATE $table_purchase SET
      time=:time, 
      abstract=:abstract, 
      project=:project,
      project_detail=:project_detail,
      budget_number=:budget_number,
      purchase_number=:purchase_number,
      purchase_unit_price=:purchase_unit_price,
      purchase_money=:purchase_money,
      budget_note=:budget_note,
      Un_purchase_number=:Un_purchase_number,
      approve_number=:approve_number,
      pay_number=:pay_number,
      pay_money=:pay_money,
      pay_should=:pay_should,
      visa_if=:visa_if,
      get_bill_if=:get_bill_if,
      got_bill=:got_bill,
      receipt_responsible=:receipt_responsible,
      invoice_money=:invoice_money,
      note=:note,
      last_modifier=:last_modifier
      WHERE id=$id
    ");
    $sth->execute(array(
        ':time' => $time,
        ':abstract' => $abstract,
        ':project' => $project,
        ':project_detail' => $project_detail,
        ':budget_number' => $budget_number,
        ':purchase_number' => $purchase_number,
        ':purchase_unit_price' => $purchase_unit_price,
        ':purchase_money' => $purchase_money,
        ':budget_note' => $budget_note,
        ':Un_purchase_number' => $Un_purchase_number,
        ':approve_number' => $approve_number,
        ':pay_number' => $pay_number,
        ':pay_money' => $pay_money,
        ':pay_should' => $pay_should,
        ':visa_if' => $visa_if,
        ':get_bill_if' => $get_bill_if,
        ':got_bill' => $got_bill,
        ':receipt_responsible' => $receipt_responsible,
        ':invoice_money' => $invoice_money,
        ':note' => $note,
        ':last_modifier' => $userid
    ));
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}

function get_if($input){
    if($input == "是")
        return 1;
    else if($input == "否")
        return 0;
}
