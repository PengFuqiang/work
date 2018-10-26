<?php
session_start();
$table_purchase = 't_purchase_all';
$table_supplier = 't_supplier_all';
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
        product_name like '%$s_productname%' and
        standard like '%$s_standard%' and
        type_number like '%$s_typenumber%' and
        project like '%$s_application%' and 
        supplier like '%$s_supplier%' and
        approve_number like '%$s_approvenumber%' and
        pay_number like '%$s_approvenumber%'
    ");
    $sth_purchase->execute();
    $items = array();
    $total = 0;
    while($row_purchase = $sth_purchase->fetch(PDO::FETCH_ASSOC)){

                if($total >= $offset && $total < ($rows + $offset)){

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

echo json_encode($result);
