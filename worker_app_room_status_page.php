<?php
$table = 't_room_status';
$skip = $_POST['skip'];
$limit = $_POST['limit'];
$offset = $skip * $limit;
include '../conn.php';

try{
        $sth = $dbh->prepare("select * from $table order by timestamp desc limit $offset,$limit");
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