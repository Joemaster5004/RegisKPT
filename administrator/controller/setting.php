<?php
require_once '../../lib/config.inc.php';

$db = new MySqlConn;
$db->connect();

 if(isset($_POST['function']) && $_POST['function'] == 'function_edit'){
    $status_regis = $_POST['id1'];
    $message = $_POST['id2'];
    $admin_pass = $_POST['id3'];
    $admin_pass_confirm = $_POST['id4'];

    if(isset($admin_pass)!="" && isset($admin_pass_confirm)!=""){
        if($admin_pass == $admin_pass_confirm){
            $field = 'status_value,status_message,admin_pass';
            $data="'$status_regis','$message','$admin_pass'";
            $sql=$db->updateData('tb_status', $field, $data,$cond=null);

            echo "success";
        }else{
            echo "not match";
        }  
    }else{
        $field = 'status_value,status_message';
        $data="'$status_regis','$message'";
        $sql=$db->updateData('tb_status', $field, $data,$cond=null);
        echo "success";
    }
    
} 
?>