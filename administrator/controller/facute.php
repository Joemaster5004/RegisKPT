<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'insert'){
    $facute_name = $_POST['id'];
    $field = 'facute_name';
    $data = "'$facute_name'";
    $sql = $db->insertData('tb_facuty', $field, $data);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_edit'){
    $id = $_POST['id'];
    $facute_name = $_POST['fc'];
    $field = 'facute_name';
    $data = "'$facute_name'";

    $sqlup = $db->updateData('tb_facuty', $field, $data, 'facute_code=' . $id);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_del'){
    $id = $_POST['id'];
    $sqldel = $db->deleteData('tb_facuty', 'facute_code=' . $id);

    echo "success";
}
