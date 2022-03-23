<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

if(isset($_POST['function']) && $_POST['function'] == 'unlockRegis'){
    $id = $_POST['id'];
    $delRegis = $db->deleteData('tb_register','stdcode='.$id);
    echo "success";
  }
?>