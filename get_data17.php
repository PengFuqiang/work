<?php
$table = "t_update";

include '../conn.php';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(DISTINCT timestamp) from $table 
        where date_format( timestamp, '%i' ) % 10 = 0
        and dev_switch = '1'  ");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(DISTINCT timestamp)'];

    $sth = $dbh->prepare("select concat( date_format( timestamp, '%Y-%m-%d %H:' ), floor( date_format( timestamp, '%i' ) /10 ) ) as time_period, 
            sum(dev_switch) as nums 
            from $table 
            where dev_switch = '1'
            group by time_period 
            limit $offset,$rows");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($items, $row);
    }
    $result['rows'] = $items;
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}
<?php
$table = "t_update";

include '../conn.php';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if($page == 0){$page = 1;}
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page-1)*$rows;

try{
    $sth = $dbh->prepare("select count(DISTINCT timestamp) from $table 
        where date_format( timestamp, '%i' ) % 10 = 0
        and dev_switch = '1'  ");
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result = array();
    $result['total'] = $row['count(DISTINCT timestamp)'];

    $sth = $dbh->prepare("select concat( date_format( timestamp, '%Y-%m-%d %H:' ), floor( date_format( timestamp, '%i' ) /10 ) ) as time_period, 
            sum(dev_switch) as nums 
            from $table 
            where dev_switch = '1'
            group by time_period 
            limit $offset,$rows");
    $sth->execute();
    $items = array();
    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
        array_push($items, $row);
    }
    $result['rows'] = $items;
}catch(PDOException $e){
    $result = array();
    $result['isError'] = $e->getMessage();
    echo json_encode($result);
    exit;
}
