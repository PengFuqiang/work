<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("Location:login.php");
    exit();
}
//添加供应商和产品相关信息时，先根据公司名称查询表中是否有这个供应商，如果没有，则新建一个公司，如果有，则直接在对应的产品表中加上即可。
$table_supplier = "t_supplier_all";

include '../../conn.php';
$company_id = 0;
try{
    $sth = $dbh->prepare("select *from $table_supplier where company_name =:company_name and product_name =:product_name limit 1");
    $sth->execute(array(
        ':company_name' => $_POST['company_name'],
        ':product_name' => $_POST['product_name']
    ));
    $query_supplier = $sth->fetch(PDO::FETCH_ASSOC);
    $supplier_id = $query_supplier['id'];
    if($supplier_id == null){//新增的公司
        $sth = $dbh->prepare("INSERT INTO $table_supplier set
        company_name=:company_name,
        address=:address,
        linkman=:linkman,
        link_phone=:link_phone,
        receiver=:receiver,
        deposit_bank=:deposit_bank,
        bank_account=:bank_account,
        product_name=:product_name,
        level=:level,
        note=:note,
        last_modifier=:last_modifier
        ");
        $sth->execute(array(
            ':company_name' => $_POST['company_name'],
            ':address' => $_POST['address'],
            ':linkman' => $_POST['linkman'],
            ':link_phone' => $_POST['link_phone'],
            ':receiver' => $_POST['receiver'],
            ':deposit_bank' => $_POST['deposit_bank'],
            ':bank_account' => $_POST['bank_account'],
            ':product_name' => $_POST['product_name'],
            ':level' => $_POST['level'],
            ':note' => $_POST['note'],
            ':last_modifier' => $_SESSION['userid']
        ));
    }else{//供应商中存在此产品更新其它
        $sth = $dbh->prepare("update $table_supplier set
            address=:address,
            linkman=:linkman,
            link_phone=:link_phone,
            receiver=:receiver,
            deposit_bank=:deposit_bank,
            bank_account=:bank_account,
            level=:level,
            note=:note,
            last_modifier=:last_modifier
            where id = $supplier_id
        ");
        $sth->execute(array(
            ':address' => $_POST['address'],
            ':linkman' => $_POST['linkman'],
            ':link_phone' => $_POST['link_phone'],
            ':receiver' => $_POST['receiver'],
            ':deposit_bank' => $_POST['deposit_bank'],
            ':bank_account' => $_POST['bank_account'],
            ':level' => $_POST['level'],
            ':note' => $_POST['note'],
            ':last_modifier' => $_SESSION['userid']
        ));
    }

}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
}

