<?php
    session_start();
    include("lib/class_db.inc.php");
    
    if($_SESSION["username"]==""){
      header('Location: ../index.php');
    }
    
     $db = new MySqlConn;
     $db->connect();
    
    
     $Total = 0;
     $SumTotal = 0;
    
     $stdcode = $_SESSION['username'];
     $orderid = $_SESSION['orderid'];
     $count = $_SESSION['count'];

     $condstd='stdcode='.$stdcode;
     $sqlstd = $db->selectOneData('tb_student','*',$condstd);
    
     $sumtotal = 0;
    for($j=0;$j<=(int)$count-1;$j++){
        $sumtotal = $sumtotal + ($_POST['txtQty'.$j] * $_POST['txtPrice'.$j]);
        if($_POST['txtProductSize'.$j]==null){
            $product_size = 0;
        }else{
            $product_size = $_POST['txtProductSize'.$j];
        }
        $field = 'order_id,stdcode,product_id,product_name,product_size,qty,price';
	    $data = "'".$orderid."','$stdcode','".$_POST['txtProductID'.$j]."','".$_POST['txtProductName'.$j]."','$product_size','".$_POST['txtQty'.$j]."','".$_POST['txtQty'.$j] * $_POST['txtPrice'.$j]."'";
	    $sql=$db->insertData('tb_order',$field,$data);
    }

    $_SESSION['sumProduct'] = $sumtotal;
?>