<?php
$table_purchase = "t_purchase_all";
$table_supplier = "t_supplier_all";
$table_user = "t_user";

include '../../conn.php';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(*) from $table_purchase
      where budget_range = 0 or budget_range = 2
    ");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(*)'];

    $sth = $dbh->prepare("select * from $table_purchase
      where budget_range = 0 or budget_range = 2 order by timestamp desc limit $offset,$rows"
    );
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){

        //修改人id转换为对应的姓名
        $user_id = $row["last_modifier"];
        $sth_user = $dbh->prepare("select * from $table_user  where id = {$user_id}");
        $sth_user->execute();
        $user_name = $sth_user->fetch(PDO::FETCH_ASSOC);
        $user_name = $user_name["username"];
        $row["last_modifier"] = $user_name;

        //得到历史最高单价
        $highest_unit_price = 0;
        $sth_product_temp = $dbh->prepare("select purchase_unit_price from $table_purchase where
            budget_range % 2 = 1 and
            product_name=:product_name and
            standard=:standard and 
            type_number=:type_number
        ");
        $sth_product_temp->execute(array(
            ':product_name'=> $row['product_name'],
            ':standard'=>$row['standard'],
            ':type_number'=>$row['type_number']
        ));
        while($row_purchase=$sth_product_temp->fetch(PDO::FETCH_ASSOC)){
                if($highest_unit_price < $row_purchase['purchase_unit_price']){
                    $highest_unit_price = $row_purchase['purchase_unit_price'];
                }
            }
        $row['highest_unit_price'] = $highest_unit_price;
        array_push($items, $row);
    }
    $result['rows'] = $items;
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}

echo json_encode($result);
