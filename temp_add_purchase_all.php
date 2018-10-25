
<?php
session_start();

$table = "t_purchase_all";

include '../../conn.php';

$p_time = $_POST['p_time'];
$p_abstract = $_POST['p_abstract'];
$p_project = $_POST['p_project'];
$p_project_detail = $_POST['p_project_detail'];
$p_supplier = $_POST['p_supplier'];
$p_level = $_POST['p_level'];
$p_product_name = $_POST['p_product_name'];
$p_standard = $_POST['p_standard'];
$p_type_number = $_POST['p_type_number'];
$p_unit = $_POST['p_unit'];
$p_budget_number = $_POST['p_budget_number'];
$p_purchase_number = $_POST['p_purchase_number'];
$p_purchase_unit_price = $_POST['p_purchase_unit_price'];
$p_purchase_money = $p_purchase_unit_price * $p_purchase_number;//采购金额
$p_budget_range = get_if($_POST['p_budget_range']);
$p_budget_note = $_POST['p_budget_note'];
$p_Un_purchase_number = $p_budget_number - $p_purchase_number;//未采购数量
$p_approve_number = $_POST['p_approve_number'];
$p_pay_number = $_POST['p_pay_number'];
$p_pay_money = $_POST['p_pay_money'];
$p_pay_should = $p_purchase_money - $p_pay_money;//应付款金额
$p_visa_if = get_if($_POST['p_visa_if']);
$p_get_bill_if = get_if($_POST['p_get_bill_if']);
$p_got_bill = $_POST['p_got_bill'];
$p_receipt_responsible = $_POST['p_receipt_responsible'];
$p_invoice_money = $_POST['p_invoice_money'];
$p_note = $_POST['p_note'];



try{
    //插入新的采购数据栏
        $sth = $dbh->prepare("INSERT INTO $table set
            time=:time, 
            abstract=:abstract,
            project=:project,
            project_detail=:project_detail, 
            supplier=:supplier,
            level=:level,
            product_name=:product_name,
            standard=:standard,
            type_number=:type_number,
            unit=:unit,
            budget_number=:budget_number,
            purchase_number=:purchase_number,
            purchase_unit_price=:purchase_unit_price,
            purchase_money=:purchase_money,
            budget_range=:budget_range,
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
        ");
        $sth->execute(array(
            ':time' => $p_time,
            ':abstract' => $p_abstract,
            ':project' => $p_project,
            ':project_detail' => $p_project_detail,
            ':supplier' => $p_supplier,
            ':level' => $p_level,
            ':product_name' => $p_product_name,
            ':standard' => $p_standard,
            ':type_number' => $p_type_number,
            ':unit' => $p_unit,
            ':budget_number' => $p_budget_number,
            ':purchase_number' => $p_purchase_number,
            ':purchase_unit_price' => $p_purchase_unit_price,
            ':purchase_money' => $p_purchase_money,
            ':budget_range' => $p_budget_range,
            ':budget_note' => $p_budget_note,
            ':Un_purchase_number' => $p_Un_purchase_number,
            ':approve_number' => $p_approve_number,
            ':pay_number' => $p_pay_number,
            ':pay_money' => $p_pay_money,
            ':pay_should' => $p_pay_should,
            ':visa_if' => $p_visa_if,
            ':get_bill_if' => $p_get_bill_if,
            ':got_bill' => $p_got_bill,
            ':receipt_responsible' => $p_receipt_responsible,
            ':invoice_money' => $p_invoice_money,
            ':note' => $p_note,
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