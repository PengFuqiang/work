<?php
$table_supplier = "t_supplier_all";

include '../../conn.php';

//utf-8 转 gb2312
function transferEncode($inputStr){
    return iconv('utf-8','gb2312',$inputStr);
}

try{
    //查询供应商相关信息
    $sth = $dbh->prepare("select * from $table_supplier order by timestamp desc");
    $sth->execute();
    $supplier = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($supplier, $row);
    }

    $str = "公司名称,地址,联系人,联系电话,收款人,开户银行,帐号,供应产品,供应商级别,备注\n";
    $str = transferEncode($str);
    for($i = 0;$i < count($supplier);$i++){
        $company_name = transferEncode($supplier[$i]['company_name']);
        $address = transferEncode($supplier[$i]['address']);
        $linkman = transferEncode($supplier[$i]['linkman']);
        $link_phone = transferEncode($supplier[$i]['link_phone']);
        $receiver = transferEncode($supplier[$i]['receiver']);
        $deposit_bank = transferEncode($supplier[$i]['deposit_bank']);
        $bank_account = transferEncode($supplier[$i]['bank_account']);
        $product_name = transferEncode($supplier[$i]['product_name']);
        $level = transferEncode($supplier[$i]['level']);
        $note = transferEncode($supplier[$i]['note']);
        $str .= $company_name.",".$address.",".$linkman.",".$link_phone.",".$receiver.",". $deposit_bank.",".$bank_account.",".$product_name.",".$level.",".$note."\n";
    }

}catch(Exception $e){
    echo '下载失败！点击此处 <a href="v_supplier.php">刷新</a><br/>';
    echo $e->getMessage();
    exit;
}

$filename = 'supplier_download_'.date('Ymd').'.csv';
header("Content-type:text/csv");
header("Content-Disposition:attachment;filename=".$filename);
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
header('Expires:0');
header('Pragma:public');
echo $str;
