<?php
session_start();
$table_purchase = 't_purchase';
$table_product = 't_product';
$table_supplier = 't_supplier';
$table_user = 't_user';

$s_productname = trim($_POST['s_productname']);
$s_standard = trim($_POST['s_standard']);
$s_typenumber = trim($_POST['s_typenumber']);
$s_application = trim($_POST['s_application']);
$s_supplier = trim($_POST['s_supplier']);
$s_approvenumber = trim($_POST['s_approvenumber']);


include '../../conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $result = array();
    $sth_purchase = $dbh->prepare("
        select*from $table_purchase where 
        project like '%$s_application%' and 
        approve_number like '%$s_approvenumber%' and
        pay_number like '%$s_approvenumber%'
    ");
    $sth_purchase->execute();
    $items = array();
    $total = 0;
    while($row_purchase = $sth_purchase->fetch(PDO::FETCH_ASSOC)){
        $sth_product = $dbh->prepare("
            select*from $table_product where
            product_name like '%$s_productname%' and
            standard like '%$s_standard%' and
            type_number like '%$s_typenumber%' and
            id = {$row_purchase['product_id']} limit 1
        ");
        $sth_product->execute();
        $row_product = $sth_product->fetch(PDO::FETCH_ASSOC);
        if($row_product != null){
            $sth_supplier = $dbh->prepare("
                select*from $table_supplier where
                company_name like '%$s_supplier%' and
                id={$row_product['company_id']} limit 1
            ");
            $sth_supplier->execute();
            $row_supplier = $sth_supplier->fetch(PDO::FETCH_ASSOC);
            if($row_supplier != null){
                if($total >= $offset && $total < ($rows + $offset)){
                    $row_purchase['product_name'] = $row_product['product_name'];
                    $row_purchase['standard'] = $row_product['standard'];
                    $row_purchase['type_number'] = $row_product['type_number'];
                    $row_purchase['unit'] = $row_product['unit'];

                    $row_purchase['supplier'] = $row_supplier['company_name'];
                    $row_purchase['level'] = get_level($row_supplier['level']);
                    $row_purchase['budget_range'] = get_if($row_purchase['budget_range']);
                    $row_purchase['visa_if'] = get_if($row_purchase['visa_if']);
                    $row_purchase['get_bill_if'] = get_if($row_purchase['get_bill_if']);

                    //修改人id转换为对应的姓名
                    $user_id = $row_purchase["last_modifier"];
                    $sth_user = $dbh->prepare("select * from $table_user  where id = {$user_id}");
                    $sth_user->execute();
                    $user_name = $sth_user->fetch(PDO::FETCH_ASSOC);
                    $user_name = $user_name["username"];
                    $row_purchase["last_modifier"] = $user_name;

                    array_push($items, $row_purchase);
                }
                $total++;
            }
        }
    }
    $total_pay_should = -1;
    $total_un_purchase = -1;
    if($s_supplier != null){
        $total_pay_should++;
        for($i = 0;$i < count($items);$i++){
            $total_pay_should += $items[$i]['pay_should'];
        }
    }
    if($s_application != null && $s_productname != null){
        $total_un_purchase++;
        for($i = 0;$i < count($items);$i++){
            $total_un_purchase += $items[$i]['Un_purchase_number'];
        }
    }
    $_SESSION['total_pay_should'] = $total_pay_should;
    $_SESSION['total_un_purchase'] = $total_un_purchase;

    $result['rows'] = $items;
    $result['total'] = $total;
}catch(PDOEXception $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}
function get_level($level){
    switch($level){
        case 1:
            return "一级";
        case 2:
            return "二级";
        case 3:
            return "三级";
        case 4:
            return "四级";
        case 5:
            return "五级";
        default:
            return "无对应级别";
    }
}
function get_if($input){
    if($input == 1)
        return "是";
    else if($input == 0)
        return "否";
    else if($input == 2)
        return "否（审批未通过）";
    else if($input == 3)
        return "是（审批已通过）";
}

echo json_encode($result);
