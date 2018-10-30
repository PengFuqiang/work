<?php
session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
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

    /*设置上传路径,wc这个地方一定要把这个路径的文件夹权限改为可读*/
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
        $table_supplier = "t_supplier_all";
        for($k=2;$k<=$highestRow;$k++){
            $company_name = $sheet->getCell("A".$k)->getValue();
            $address = $sheet->getCell("B".$k)->getValue();
            $linkman = $sheet->getCell("C".$k)->getValue();
            $link_phone = $sheet->getCell("D".$k)->getValue();
            $receiver = $sheet->getCell("E".$k)->getValue();
            $deposit_bank = $sheet->getCell("F".$k)->getValue();
            $bank_account = $sheet->getCell("G".$k)->getValue();
            $product_name = $sheet->getCell("H".$k)->getValue();
            $level = $sheet->getCell("I".$k)->getValue();
            $note = $sheet->getCell("J".$k)->getValue();

            $sth = $dbh->prepare("select *from $table_supplier where company_name =:company_name and product_name =:product_name limit 1");
            $sth->execute(array(
                ':company_name' => $company_name
            ));
            $query_supplier = $sth->fetch(PDO::FETCH_ASSOC);

            if($query_supplier == null){//新增的公司
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
                    ':company_name' => $company_name,
                    ':address' => $address,
                    ':linkman' => $linkman,
                    ':link_phone' => $link_phone,
                    ':receiver' => $receiver,
                    ':deposit_bank' => $deposit_bank,
                    ':bank_account' => $bank_account,
                    ':product_name' => $product_name,
                    ':level' => $level,
                    ':note' => $note,
                    ':last_modifier' => $_SESSION['userid']
                ));
            }else{//在原有的公司上添加产品，更新最后修改人
                $supplier_id = $query_supplier['id'];
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
                    ':address' => $address,
                    ':linkman' => $linkman,
                    ':link_phone' => $link_phone,
                    ':receiver' => $receiver,
                    ':deposit_bank' => $deposit_bank,
                    ':bank_account' => $bank_account,
                    ':level' => $level,
                    ':note' => $note,
                    ':last_modifier' => $_SESSION['userid']
                ));
            }
        }
    }catch (PDOException $e){
        echo '导入失败！点击此处 <a href="v_supplier.php">刷新</a><br/>';
        echo $e->getMessage();
        exit;
    }

    echo '导入成功！点击此处 <a href="v_supplier.php">刷新</a>';
}
