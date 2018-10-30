<?php
session_start();

$table_purchase = 't_purchase_all';

$product_name = $_GET['product_name'];

include '../../conn.php';


try{
    if($product_name != null){
        
        //根据公司查询公司对应的产品
        $sth = $dbh->prepare("select distinct type_number from $table_purchase where
            product_name=:product_name
        ");
        $sth->execute(array(
            ':product_name' => $product_name
        ));
        $items = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            array_push($items,$row);
        }
        if(count($items) == 0){
            $temp['type_number'] = "该产品未定型号";
            array_push($items,$temp);
        }
        $result = $items;
    }else{
        $temp['type_number'] = "尚未选择产品";
        $items = array();
        array_push($items,$temp);
        $result = $items;
    }

}catch (PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}
echo json_encode($result);
