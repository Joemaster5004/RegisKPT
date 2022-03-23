<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'check_qr'){
    $sql = $db->selectOneData('tb_qrcode','*',$cond='id='.$_POST['id']);
        $data['img'] = $sql['files_qr'];

    echo json_encode($data);
} else if(isset($_POST['function']) && $_POST['function'] == 'function_del'){
    $id = $_POST['id'];
    $sqldel = $db->deleteData('tb_qrcode', 'id=' . $id);

    echo "success";
}
