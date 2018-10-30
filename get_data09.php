<?php

include '../../conn.php';
$table_supplier = "t_supplier_all";
$table_user = "t_user";

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $result = array();

    //查询供应商相关信息
    $sth = $dbh->prepare("select * from $table_supplier order by timestamp desc");
    $sth->execute();
    $supplier = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($supplier, $row);
    }

    $total_supplier = array();
    $total = 0;
    for($i = 0;$i < count($supplier);$i++){
        $sth = $dbh->prepare("select * from $table_supplier where id = {$supplier[$i]['id']}");
        $sth->execute();

        //最后修改人id转换为对应的姓名
        $user_id = $supplier[$i]["last_modifier"];
        $sth_user = $dbh->prepare("select * from $table_user  where id = {$user_id}");
        $sth_user->execute();
        $user_name = $sth_user->fetch(PDO::FETCH_ASSOC);
        $user_name = $user_name["username"];
        $supplier[$i]["last_modifier"] = $user_name;
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            if($total >= $offset && $total < ($rows + $offset)){
                array_push($total_supplier,$supplier[$i]);
            }
            $total++;
        }
    }
    $result['rows'] = $total_supplier;
    $result['total'] = $total;
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}


echo json_encode($result);
