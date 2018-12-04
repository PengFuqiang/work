<?php
$table = 't_app_repair';
$phone = $_POST['phone'];
include '../conn.php';

try{
        $sth = $dbh->prepare("select count(*) from $table where phone like '$phone'");
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);


        $sth = $dbh->prepare("select * from $table where phone like '$phone' order by timestamp desc ");
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