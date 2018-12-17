<?php
$table = 't_worker_app_user';
include '../html/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

try{
        $sth = $dbh->prepare("select count(*) from $table where username like '$username'");
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);


        $sth = $dbh->prepare("select * from $table where username like '$username'");
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
}

        $user_data=json_encode($result);

if($result[0]['password'] == $password){
        echo ($user_data);
        }else{
        echo ('{"msg":"NO"}');
        }
