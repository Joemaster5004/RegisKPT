<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'function_insert'){
   $majorid = $_POST['id1'];
   $stdclass = $_POST['id2'];
   $facute_code = $_POST['id3'];
   $majorname = $_POST['id4'];

   $field = 'majorid,cid,facute_code,majorname';
   $data="'$majorid','$stdclass','$facute_code','$majorname'";

   $sql=$db->insertData('tb_major',$field,$data);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_edit'){
    $majorid = $_POST['id1'];
    $depart_name = $_POST['id2'];

    $field = 'majorid,majorname';
    $data="'$majorid','$depart_name'";

    $sql = $db->updateData('tb_major',$field,$data,'majorid='.$_POST['id']);

    echo "success";
} else if(isset($_POST['function']) && $_POST['function'] == 'function_del'){
    $id = $_POST['id'];
 	$sql = $db->deleteData('tb_major','majorid='.$id);

    echo "success";
}
