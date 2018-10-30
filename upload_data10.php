<?php
session_start();

if(!empty($_FILES ['file_stu'] ['name'])){
    $tmp_file = $_FILES ['file_stu'] ['tmp_name'];
    $file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
    $file_type = $file_types [count ( $file_types ) - 1];

    /*判别是不是.xls文件，判别是不是excel文件*/
    if(strtolower($file_type) == "xls" or strtolower($file_type) == "xlsx"){
    }else{
        //$this->error ( '不是Excel文件，重新上传' );
        echo '<script>alert(\'不是Excel文件，重新上传!\');history.go(-1);</script>';
    }

    /*设置上传路径*/
    $savePath = '../../../upfile/excel/';

    /*以时间来命名上传的文件*/
     $str = date ( 'Ymdhis' );
     $file_name = $str . "." . $file_type;

     /*是否上传成功*/
    if(!copy($tmp_file, $savePath . $file_name)){
        //$this->error ( '上传失败' );
        echo '<script>alert(\'上传失败!\');</script>';
    }

    require_once '../../../Classes/PHPExcel.php';
    require_once '../../../Classes/PHPExcel/IOFactory.php';
    require_once '../../../Classes/PHPExcel/Reader/Excel5.php';
    include '../../conn.php';

    if(strtolower($file_type) == "xls"){
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
    }else{
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    }
    $objPHPExcel = $objReader->load($savePath . $file_name);
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow(); // 取得总行数 


    try{
        $table_purchase = "t_purchase_all";
        $table_supplier = 't_supplier_all';

        for($j=2;$j<=$highestRow;$j++){
            $time=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($sheet->getCell("A".$j)->getValue()));
            $abstract = process_excel($sheet->getCell("B".$j)->getValue());
            $project = process_excel($sheet->getCell("C".$j)->getValue());
            $project_detail = process_excel($sheet->getCell("D".$j)->getValue());
            $supplier = process_excel($sheet->getCell("E".$j)->getValue());
            $level = process_excel($sheet->getCell("F".$j)->getValue());
            $product_name = process_excel($sheet->getCell("G".$j)->getValue());
            $standard = process_excel($sheet->getCell("H".$j)->getValue());
            $type_number = process_excel($sheet->getCell("I".$j)->getValue());
            $unit = process_excel($sheet->getCell("J".$j)->getValue());
            $budget_number = process_excel($sheet->getCell("K".$j)->getValue());
            $purchase_number = process_excel($sheet->getCell("L".$j)->getValue());
            $purchase_unit_price = process_excel($sheet->getCell("M".$j)->getValue());
            $purchase_money = process_excel($purchase_unit_price * $purchase_number);//采购金额
            $budget_range = get_if(process_excel($sheet->getCell("O".$j)->getValue()));;
            $budget_note = process_excel($sheet->getCell("P".$j)->getValue());
            $Un_purchase_number = $budget_number - $purchase_number;//未采购数量
            $approve_number = process_excel($sheet->getCell("R".$j)->getValue());
            $pay_number = process_excel($sheet->getCell("S".$j)->getValue());
            $pay_money = process_excel($sheet->getCell("T".$j)->getValue());
            $pay_should = $purchase_money - $pay_money;//应付款金额
            $visa_if = get_if(process_excel($sheet->getCell("V".$j)->getValue()));
            $get_bill_if = get_if(process_excel($sheet->getCell("W".$j)->getValue()));
            $got_bill = process_excel($sheet->getCell("X".$j)->getValue());
            $receipt_responsible = process_excel($sheet->getCell("Y".$j)->getValue());
            $invoice_money = process_excel($sheet->getCell("Z".$j)->getValue());
            $note = process_excel($sheet->getCell("AA".$j)->getValue());
            $userid = $_SESSION['userid'];

            //根据产品名称、规格、型号查询该产品的历史价格，并与当前采购价格进行对比
            $sth_product = $dbh->prepare("select * from $table_purchase where
              product_name=:product_name and
              standard=:standard and 
              type_number=:type_number
            ");
            $sth_product->execute(array(
                ':product_name'=>$product_name,
                ':standard'=>$standard,
                ':type_number'=>$type_number
            ));
            while($row_product = $sth_product->fetch(PDO::FETCH_ASSOC)){
                while($row_purchase = $row_product->fetch(PDO::FETCH_ASSOC)){
                    //从budget_range为1或3的单价中进行比较
                    if($row_purchase['budget_range'] % 2 == 1){
                        $temp_purchase_unit_price = $row_purchase['purchase_unit_price'];
                        if($purchase_unit_price <= $temp_purchase_unit_price){
                            $budget_range = 1;
                            break;
                        }
                    }
                }
                if($budget_range == 1)break;
            }
            //如果数据库里面没有该产品的相关数据，也要审批
            if($row_product == null) $budget_range = 0;
            if($budget_range == 0) $budget_note = "单价超出预算";
            else $budget_note = "单价在预算范围内";


            //根据公司id和company_name查找对应的产品
            $sth_product = $dbh->prepare("select*from $table_supplier where
                company_name=:company_name AND
                product_name=:product_name
            ");
            $sth_product->execute(array(
                ':company_name' => $supplier,
                ':product_name' => $product_name
            ));
            $row_product = $sth_product->fetch(PDO::FETCH_ASSOC);
            if ($row_product != null) {
                //插入新的采购数据栏
                $sth = $dbh->prepare("INSERT INTO $table_purchase set
                    time=:time, 
                    abstract=:abstract,
                    project=:project,
                    project_detail=:project_detail, 
                    supplier=:supplier,
                    level=:level,
                    product_name=:product_name,
                    standard=:standard,
                    type_number=:type_number,
                    unit=:unit,          
                    budget_number=:budget_number,
                    purchase_number=:purchase_number,
                    purchase_unit_price=:purchase_unit_price,
                    purchase_money=:purchase_money,
                    budget_range=:budget_range,
                    budget_note=:budget_note,
                    Un_purchase_number=:Un_purchase_number,
                    approve_number=:approve_number,
                    pay_number=:pay_number,
                    pay_money=:pay_money,
                    pay_should=:pay_should,
                    visa_if=:visa_if,
                    get_bill_if=:get_bill_if,
                    got_bill=:got_bill,
                    receipt_responsible=:receipt_responsible,
                    invoice_money=:invoice_money,
                    note=:note,
                    last_modifier=:last_modifier
                ");
                $sth->execute(array(
                    ':time' => $time,
                    ':abstract' => $abstract,
                    ':project' => $project,
                    ':project_detail' => $project_detail,
                    ':supplier' => $supplier,
                    ':level' => $level,
                    ':product_name' => $product_name,
                    ':standard' => $standard,
                    ':type_number' => $type_number,
                    ':unit' => $unit,
                    ':budget_number' => $budget_number,
                    ':purchase_number' => $purchase_number,
                    ':purchase_unit_price' => $purchase_unit_price,
                    ':purchase_money' => $purchase_money,
                    ':budget_range' => $budget_range,
                    ':budget_note' => $budget_note,
                    ':Un_purchase_number' => $Un_purchase_number,
                    ':approve_number' => $approve_number,
                    ':pay_number' => $pay_number,
                    ':pay_money' => $pay_money,
                    ':pay_should' => $pay_should,
                    ':visa_if' => $visa_if,
                    ':get_bill_if' => $get_bill_if,
                    ':got_bill' => $got_bill,
                    ':receipt_responsible' => $receipt_responsible,
                    ':invoice_money' => $invoice_money,
                    ':note' => $note,
                    ':last_modifier' => $userid
                ));
            }
        }
    }catch (PDOException $e){
        echo '导入失败！点击此处 <a href="v_purchase.php">刷新</a><br/>';
    echo $e->getMessage();
        exit;
    }
    echo '导入成功！点击此处 <a href="v_purchase.php">刷新</a>';
}
function get_if($input){
    if($input == "是")
        return 1;
    else if($input == "否")
        return 0;
}
function process_excel($input){
    return trim($input);
}
