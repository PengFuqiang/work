<?php
$dsn = 'mysql:dbname=zmdb; host=127.0.0.1; charset=utf8';
$user = 'root';
$password = 'Wuhanhongtu1712';

try{
    $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("set names utf8");
}catch(PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}
?>