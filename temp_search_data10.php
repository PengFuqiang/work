<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hangyy
 * Date: 2018/7/4
 * Time: 13:28
 * 保存search_data10.php查询到的数据，并存入session中，供汇总需要
 */
$result['total_pay_should'] = $_SESSION['total_pay_should'];
$result['total_un_purchase'] = $_SESSION['total_un_purchase'];
echo json_encode($result);
