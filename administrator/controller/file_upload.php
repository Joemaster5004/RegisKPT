<?php
error_reporting(0);
ini_set('display_errors', 0);
require_once '../../lib/config.inc.php';  
$url = $_SERVER['PHP_SELF']."?";

 $db = new MySqlConn;
 $db->connect();

if(!empty($_FILES)){     
    $upload_dir = "../uploads/qrcode/";
    $fileDoc = $_FILES["file"]["name"];
    $type = strrchr($_FILES["file"]["name"],".");
    $fileName = basename($fileDoc, $type); 
    $uploaded_file = $upload_dir.$fileDoc;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){
        $field = 'stdcode,files_qr';
        $data="'$fileName','$fileDoc'";
        $sql = $db->insertData('tb_qrcode',$field,$data,$cond=null);
    }   
}
?>