<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

//update
if(isset($_POST['function']) && $_POST['function'] == 'function_edit'){
    $id = $_POST['id1'];
    $money = $_POST['id2'];
    $field = 'money';
    $data="'$money'";

    $sql = $db->updateData('tb_register',$field,$data,'stdcode='.$id);
    echo "success";
 }
