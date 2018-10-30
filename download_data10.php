<?php
$table_purchase = "t_purchase_all";

include '../../conn.php';

function get_if($input){
    if($input == 1)
        return "否";
    else if($input == 2)
        return "否（审批未通过）";
    else if($input == 3)
        return "是（审批已通过）";
}
//utf-8 转 gb2312
function transferEncode($inputStr){
    return iconv('utf-8','gb2312',$inputStr);
}
try{
    $sth = $dbh->prepare("select * from $table_purchase order by timestamp desc");
    $sth->execute();
    $total_purchase = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        $row['budget_range'] = get_if($row['budget_range']);
        $row['visa_if'] = get_if($row['visa_if']);
        $row['get_bill_if'] = get_if($row['get_bill_if']);

        array_push($total_purchase, $row);
    }

    $str = transferEncode($str);
    for($i = 0;$i < count($total_purchase);$i++){
        $time = transferEncode($total_purchase[$i]['time']);
        $abstract = transferEncode($total_purchase[$i]['abstract']);
        $project = transferEncode($total_purchase[$i]['project']);
        $project_detail = transferEncode($total_purchase[$i]['project_detail']);
        $supplier = transferEncode($total_purchase[$i]['supplier']);
        $level = transferEncode($total_purchase[$i]['level']);
        $product_name = transferEncode($total_purchase[$i]['product_name']);
        $standard = transferEncode($total_purchase[$i]['standard']);
        $type_number = transferEncode($total_purchase[$i]['type_number']);
        $unit = transferEncode($total_purchase[$i]['unit']);
        $budget_number = transferEncode($total_purchase[$i]['budget_number']);
        $purchase_number = transferEncode($total_purchase[$i]['purchase_number']);
        $purchase_unit_price = transferEncode($total_purchase[$i]['purchase_unit_price']);
        $purchase_money = transferEncode($total_purchase[$i]['purchase_money']);
        $budget_range = transferEncode($total_purchase[$i]['budget_range']);
        $budget_note = transferEncode($total_purchase[$i]['budget_note']);
        $Un_purchase_number = transferEncode($total_purchase[$i]['Un_purchase_number']);
        $approve_number = transferEncode($total_purchase[$i]['approve_number']);
        $pay_number = transferEncode($total_purchase[$i]['pay_number']);
        $pay_money = transferEncode($total_purchase[$i]['pay_money']);
        $pay_should = transferEncode($total_purchase[$i]['pay_should']);
        $visa_if = transferEncode($total_purchase[$i]['visa_if']);
        $get_bill_if = transferEncode($total_purchase[$i]['get_bill_if']);
        $got_bill = transferEncode($total_purchase[$i]['got_bill']);
        $receipt_responsible = transferEncode($total_purchase[$i]['receipt_responsible']);
        $invoice_money = transferEncode($total_purchase[$i]['invoice_money']);
        $note = transferEncode($total_purchase[$i]['note']);
        $str .= $time . "," . $abstract . "," . $project . "," . $project_detail .
            "," . $supplier . "," . $level . "," . $product_name . "," . $standard .
            "," . $type_number . "," . $unit . "," . $budget_number . "," . $purchase_number .
            "," . $purchase_unit_price . "," . $purchase_money . "," . $budget_range . "," . $budget_note .
            "," . $Un_purchase_number . "," . $approve_number . "," .$pay_number .
            "," . $pay_money . "," . $pay_should . "," .$visa_if . "," .$get_bill_if .
            "," . $got_bill . "," . $receipt_responsible . "," . $invoice_money . "," . $note . "\n";
    }
}catch(PDOException $e){
    echo '下载失败！点击此处 <a href="v_purchase.php">刷新</a><br/>';
    echo $e->getMessage();
    exit;
}

$filename = 'purchase_download_'.date('Ymd').'.csv';

header("Content-type:text/csv");
header("Content-Disposition:attachment;filename=".$filename);
header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
header('Expires:0');
header('Pragma:public');
echo $str;
