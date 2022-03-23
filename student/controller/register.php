<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
session_start();
require_once '../../lib/config.inc.php';
$url = $_SERVER['PHP_SELF'] . "?";

$db = new MySqlConn;
$db->connect();

 $stdcode = $_SESSION['username'];

 $condition='stdcode='.$stdcode;
 $sql1 = $db->selectOneData('tb_student','*',$condition);
 $_SESSION['peopleid'] = $sql1['peopleid'];
 $_SESSION['cid'] = $sql1['cid'];
 $mjid = $sql1['majorid1'];
 
if(isset($_GET['insert'])){
    $peopleid = $_SESSION['peopleid'];
    $cid = $_SESSION['cid'];
    $money = $_POST['txtMoney'];
    
    if(trim($_FILES["file_image"]["tmp_name"]) != ""){
      $type = strrchr($_FILES["file_image"]["name"],".");
      $images = $_FILES["file_image"]["tmp_name"];
      $imgRegis = "slip_".date("Ymd").rand(0000,9999).$type;
      copy($_FILES["file_image"]["tmp_name"],"../uploads/slip/".$imgRegis);
      
    if($stdcode != null && $peopleid != null && $cid != null && $imgRegis != null){
          $condition='stdcode='.$stdcode;
          $sql2 = $db->selectOneData('tb_register','*',$condition);
          $codeid = @($sql2['stdcode']);
          $status = 1;

        if( $codeid == $stdcode){
          //echo "<script>alert('คุณได้ลงทะเบียนเรียบร้อยแล้ว'); window.location ='index.php';</script>";
          echo '
                <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            title: "ขออภัย",
                            text: "คุณขึ้นทะเบียนแล้ว รออนุมัติจากงานทะเบียน !",
                            icon: "warning",
                            buttons: ["ยกเลิก","ตกลง"],
                            dangerMode: true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {			
                                window.location.href = "../index.php";
                            }
                        })
                    });
                </script>
            ';
        }else{
          $field = 'stdcode,peopleid,majorid,regis_date,std_class,status,money,image';
          $data = "'$stdcode','$peopleid','$mjid',NOW(),'$cid','$status','$money','$imgRegis'";

          $sql3=$db->insertData('tb_register',$field,$data);
          //header('Location: index.php');
          echo '
                <script type="text/javascript">
                    $(document).ready(function(){
                        swal({
                            title: "สำเร็จ",
                            text: "บันทึกเรียบร้อย รออนุมัติจากงานทะเบียน !",
                            icon: "success",
                            buttons: ["ยกเลิก","ตกลง"],
                            dangerMode: true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {			
                                window.location.href = "../index.php";
                            }
                        })
                    });
                </script>
            ';
        }
      }    
    }
}
?>