<?php
session_start();
$table_purchase = "t_purchase";
$table_supplier = 't_supplier';
$table_product = 't_product';

include '../../conn.php';

$time = $_POST['time'];
$abstract = $_POST['abstract'];
$project = $_POST['project'];
$project_detail = $_POST['project_detail'];
$budget_number = $_POST['budget_number'];
$purchase_number = $_POST['purchase_number'];
$purchase_unit_price = $_POST['purchase_unit_price'];
$purchase_money = $purchase_unit_price * $purchase_number;//采购金额
$budget_range = 0;
$budget_note = $_POST['budget_note'];
$Un_purchase_number = $budget_number - $purchase_number;//未采购数量
$approve_number = $_POST['approve_number'];
$pay_number = $_POST['pay_number'];
$pay_money = $_POST['pay_money'];
$pay_should = $purchase_money - $pay_money;//应付款金额
$visa_if = get_if($_POST['visa_if']);
$get_bill_if = get_if($_POST['get_bill_if']);
$got_bill = $_POST['got_bill'];
$receipt_responsible = $_POST['receipt_responsible'];
$invoice_money = $_POST['invoice_money'];
$note = $_POST['note'];
$userid = $_SESSION['userid'];

try {

    /*$product_name = $_POST['product_name'];
    $standard = $_POST['standard'];
    $type_number = $_POST['type_number'];
    $sth_product = $dbh->prepare("select * from $table_product where
      product_name like '%$product_name%' and
      standard like '%$standard%' and
      type_number like '%$type_number'
    ");*/
    //根据产品名称、规格、型号查询该产品的历史价格，并与当前采购价格进行对比
    $sth_product = $dbh->prepare("select * from $table_product where
      product_name=:product_name and
      standard=:standard and 
      type_number=:type_number
    ");
    $sth_product->execute(array(
        ':product_name'=>$_POST['product_name'],
        ':standard'=>$_POST['standard'],
        ':type_number'=>$_POST['type_number']
    ));
    while($row_product = $sth_product->fetch(PDO::FETCH_ASSOC)){
        $product_id = $row_product['id'];
        $sth_purchase = $dbh->prepare("select*from $table_purchase where
            product_id=:product_id      
        ");
        $sth_purchase->execute(array(
           ':product_id' => $product_id
        ));
        while($row_purchase = $sth_purchase->fetch(PDO::FETCH_ASSOC)){
            //从budget_range为1或3的单价中进行比较
            if($row_purchase['budget_range'] % 2 == 1){
                $temp_purchase_unit_price = $row_purchase['purchase_unit_price'];
                if($purchase_unit_price <= $temp_purchase_unit_price){
                    $budget_range = 1;
                    break;
                }
            }
        }
        if($budget_range == 1)break;
    }
    //如果数据库里面没有该产品的相关数据，也要审批
    if($row_product == null) $budget_range = 0;
    if($budget_range == 0) $budget_note = "单价超出预算";
    else $budget_note = "单价在预算范围内";

    //根据新输入的company_name查找对应的公司id
    $sth_company = $dbh->prepare("select * from $table_supplier where
      company_name=:company_name
    ");
    $sth_company->execute(array(
        ':company_name' => $_POST['supplier']
    ));
    $row_company = $sth_company->fetch(PDO::FETCH_ASSOC);
    $company_id = $row_company['id'];

    //根据公司id和company_name查找对应的产品
    $sth_product = $dbh->prepare("select*from $table_product where
        company_id=:company_id AND
        product_name=:product_name
    ");
    $sth_product->execute(array(
        ':company_id' => $company_id,
        ':product_name' => $_POST['product_name']
    ));
    $row_product = $sth_product->fetch(PDO::FETCH_ASSOC);
    if ($row_product != null) {
        //更新产品相关信息
        $product_id = $row_product['id'];
        $sth_product = $dbh->prepare("INSERT into $table_product set
            company_id = $company_id,
            product_name =:product_name,
            standard =:standard,
            type_number =:type_number,
            unit =:unit        
        ");
        
        $sth_product->execute(array(
            ':standard' => $_POST['standard'],
            ':type_number' => $_POST['type_number'],
            ':unit' => $_POST['unit']
        ));
        //插入新的采购数据栏
        $sth = $dbh->prepare("INSERT INTO $table_purchase set
            time=:time, 
            abstract=:abstract,
            project=:project,
            project_detail=:project_detail, 
            product_id=:product_id,          
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
            last_modifier=:last_modifier
        ");
        $sth->execute(array(
            ':time' => $time,
            ':abstract' => $abstract,
            ':project' => $project,
            ':project_detail' => $project_detail,
            ':product_id' => $product_id,
            ':budget_number' => $budget_number,
            ':purchase_number' => $purchase_number,
            ':purchase_unit_price' => $purchase_unit_price,
            ':purchase_money' => $purchase_money,
            ':budget_range' => $budget_range,
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
    }
} catch (PDOException $e) {
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