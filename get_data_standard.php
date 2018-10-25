<?php
$table = 't_product';

include '../../conn.php';

try{
    $sth = $dbh->prepare("select distinct standard from $table");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($items, $row);
    }
    $result = $items;
}catch(PDOEXception $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}
echo json_encode($result);