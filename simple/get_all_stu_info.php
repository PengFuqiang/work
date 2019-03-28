<?php
session_start();

$table = "t_online_education_studentInfo";


include('conn.php');


try{
        $sth = $dbh->prepare("select * from $table order by id");
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
