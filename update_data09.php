<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("Location:login.php");
    exit();
}
$table_supplier = "t_supplier_all";

include '../../conn.php';

$id = intval($_REQUEST['id']);
$company_name=$_POST['company_name'];
$address = $_POST['address'];
$linkman = $_POST['linkman'];
$link_phone = $_POST['link_phone'];
$receiver = $_POST['receiver'];
$deposit_bank = $_POST['deposit_bank'];
$bank_account = $_POST['bank_account'];
$product_name = $_POST['product_name'];
$level = $_POST['level'];
$note = $_POST['note'];
$userid = $_SESSION['userid'];
//仅仅更新公司的相关信息
try{
    $sth = $dbh->prepare("UPDATE $table_supplier SET 
    company_name=:company_name,
    address=:address,
    linkman=:linkman,
    link_phone=:link_phone,
    receiver=:receiver,
    deposit_bank=:deposit_bank,
    bank_account=:bank_account,
    product_name=:product_name,  
    level=:level,
    note=:note,
    last_modifier=:last_modifier
    WHERE id=$id
    ");
    $sth->execute(array(
        ':company_name' => $company_name,
        ':address' => $address,
        ':linkman' => $linkman,
        ':link_phone' => $link_phone,
        ':receiver' => $receiver,
        ':deposit_bank' => $deposit_bank,
        ':bank_account' => $bank_account,
        ':product_name' => $product_name,
        ':level' => $level,
        ':note' => $note,
        ':last_modifier' => $userid
    ));
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}
