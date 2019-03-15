<?php
$table = 't_paybill';
$selecttime_b = $_POST['selecttime_b'];
$selecttime_e = $_POST['selecttime_e'];
$where = "('$selecttime_b'<=timestamp and timestamp<'$selecttime_e') or (timestamp like '$selecttime_e%')";
$where_local = "(('$selecttime_b'<=timestamp and timestamp<'$selecttime_e') or (timestamp like '$selecttime_e%')) and bill_type='现场网络缴费'";
$where_app = "(('$selecttime_b'<=timestamp and timestamp<'$selecttime_e') or (timestamp like '$selecttime_e%')) and bill_type='网络'";

include '../conn.php';

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(*) from $table where ".$where);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(*)'];

    $sth = $dbh->prepare("select sum(bill_pay) from $table where ".$where);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result['pay_all'] = $row['sum(bill_pay)'];

    $sth = $dbh->prepare("select sum(bill_pay) from $table where ".$where_local);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result['pay_local'] = $row['sum(bill_pay)'];

    $sth = $dbh->prepare("select sum(bill_pay) from $table where ".$where_app);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result['pay_app'] = $row['sum(bill_pay)'];

    $sth = $dbh->prepare("select * from $table where ".$where." order by timestamp desc limit $offset,$rows");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($items, $row);
    }
    $result["rows"] = $items;
}catch(PDOEXception $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}

echo json_encode($result);