<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'updateRegis'){
    //Update Status
    $id = $_POST['id'];
    $field = 'status';
    $data = 2;
    $sqlUpdateReg = $db->updateData('tb_register',$field,$data,'stdcode='.$id);
    echo "success";
  }else if(isset($_POST['function']) && $_POST['function'] == 'regisCancle'){
    //Update Status
    $id = $_POST['id'];
    $field = 'status';
    $data = 3;
    $sqlUpdateReg = $db->updateData('tb_register',$field,$data,'stdcode='.$id);
    echo "success";
  }
