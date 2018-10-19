
<?php
$table_purchase = "t_purchase";
$table_product = "t_product";
$table_supplier = "t_supplier";
$table_user = "t_user";

include '../../conn.php';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(*) from $table_purchase");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(*)'];

    $sth = $dbh->prepare("select * from $table_purchase order by timestamp desc limit $offset,$rows");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $sth_pro = $dbh->prepare("select * from $table_product where id={$row['product_id']} limit 1");
        $sth_pro->execute();
        $row_product = $sth_pro->fetch(PDO::FETCH_ASSOC);
        $row['product_name'] = $row_product['product_name'];
        $row['standard'] = $row_product['standard'];
        $row['type_number'] = $row_product['type_number'];
        $row['unit'] = $row_product['unit'];

        $sth_supplier = $dbh->prepare("select * from $table_supplier where id={$row_product['company_id']} limit 1");
        $sth_supplier->execute();
        $row_supplier = $sth_supplier->fetch(PDO::FETCH_ASSOC);
        $row['supplier'] = $row_supplier['company_name'];
        $row['level'] = get_level($row_supplier['level']);
        $row['budget_range'] = get_if($row['budget_range']);
        $row['visa_if'] = get_if($row['visa_if']);
        $row['get_bill_if'] = get_if($row['get_bill_if']);
        //修改人id转换为对应的姓名
        $user_id = $row["last_modifier"];
        $sth_user = $dbh->prepare("select * from $table_user  where id = {$user_id}");
        $sth_user->execute();
        $user_name = $sth_user->fetch(PDO::FETCH_ASSOC);
        $user_name = $user_name["username"];
        $row["last_modifier"] = $user_name;

        array_push($items, $row);
    }
    $result['rows'] = $items;
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
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