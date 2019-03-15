<?php
$table = "t_paybill_insert";

include '../conn.php';
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