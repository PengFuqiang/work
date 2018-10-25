<?php
session_start();

$table_supplier = 't_supplier';
$table_product = 't_product';
$company_name = $_GET['company_name'];

include '../../conn.php';


try{
    if($company_name != null){
        //根据公司名字查询对应的公司id
        $sth = $dbh->prepare("select*from $table_supplier where
            company_name=:company_name limit 1
        ");
        $sth->execute(array(
            ':company_name' => $company_name
        ));
        $supplier = $sth->fetch(PDO::FETCH_ASSOC);
        $company_id = $supplier['id'];
        //根据公司id查询公司对于的产品
        $sth = $dbh->prepare("select distinct product_name,unit from $table_product where
            company_id=:company_id
        ");
        $sth->execute(array(
            ':company_id' => $company_id
        ));
        $items = array();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)){
            array_push($items,$row);
        }
        if(count($items) == 0){
            $temp['product_name'] = "该公司下未有相关产品";
            array_push($items,$temp);
        }
        $result = $items;
    }else{
        $temp['product_name'] = "尚未选择公司";
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
