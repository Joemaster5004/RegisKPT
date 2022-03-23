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
 $date = date("Y-m-d H:i:s");

 $stdcode = $_SESSION['username'];

 $condition='stdcode='.$stdcode;
 $sql1 = $db->selectOneData('tb_student','*',$condition);
    $_SESSION['peopleid'] = $sql1['peopleid'];
    $mjid = $sql1['majorid1'];
    $cid = $sql1['cid'];

 
if(isset($_SESSION['orderid'])){
    $peopleid = $_SESSION['peopleid'];
    $money = $_POST['txtMoney'];

    if(trim($_FILES["file_image"]["tmp_name"]) != ""){
        $type = strrchr($_FILES["file_image"]["name"],".");
        $images = $_FILES["file_image"]["tmp_name"];
        $new_images = "pay_".date("Ymd").rand(0000,9999).$type;
        copy($_FILES["file_image"]["tmp_name"],"uploads/pay/".$new_images);
    }

    if($stdcode != null && $peopleid != null && $new_images != null){
        $condition='stdcode='.$stdcode;
        $sql3 = $db->selectOneData('tb_pay','*',$condition);
        $codeid = $sql3['stdcode'];
        $status = 1;

        if( $codeid == $stdcode){
            echo "<script>alert('คุณได้ลงทะเบียนเรียบร้อยแล้ว'); window.location ='index.php';</script>";
        }else{
            $field = 'stdcode,peopleid,majorid,std_class,pay_date,status,money,image';
            $data = "'$stdcode','$peopleid','$mjid','$cid',NOW(),'$status','$money','$new_images'";

            $sqlpay=$db->insertData('tb_pay',$field,$data);
        }
    } 
}

$money = $_POST['txtMoney'];
$cond='stdcode='.$stdcode;
$sql = $db->selectOneData('tb_pay','*',$cond);
if($sql['money']!=''){
    $condUp='stdcode='.$stdcode;
    $field = 'money';
    $data="'$money'";
    $sql = $db->updateData('tb_pay',$field,$data,$condUp);
}

 unset($_SESSION["orderid"]);

 header("location: order_list.php");


?>