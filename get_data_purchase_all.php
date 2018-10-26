<?php

$table = "t_purchase_all";
$table_user = "t_user";

include '../../conn.php';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(*) from $table");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(*)'];

    $sth = $dbh->prepare("select * from $table order by timestamp desc limit $offset,$rows");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){

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