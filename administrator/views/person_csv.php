<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
include 'lib/class_db.inc.php';  

include("date.php");

if($_SESSION["user"]==""){
  header('Location: ../index.php');
}

 $db = new MySqlConn;
 $db->connect();

 if(isset($_GET['addcsv'])){
    $type = strrchr($_FILES['fileCSV']['name'],".");
    $newname = "std_".date("dmY").rand(000,999).$type;
    copy($_FILES['fileCSV']['tmp_name'],'uploads/csv/'.$newname);
    $objCSV = fopen("uploads/csv/".$newname, "r");
    $_SESSION['num']=0;
    while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE) {
            $_SESSION['count']++;
            $count=$_SESSION['count'];
            $item="user$count";
            $status="";
            $_SESSION['num']++;

            if($status==""){
                for($i=0;$i<=9;$i++){
                   $_SESSION[$item][$i]=$objArr[$i]; 
                }
                $_SESSION['student'][$count]=$item;
            }
            
            $obj0=$_SESSION[$item][0];
            $obj1=$_SESSION[$item][1];
            $obj2=$_SESSION[$item][2];
            $obj3=$_SESSION[$item][3];
            $obj4=$_SESSION[$item][4];
            $obj5=$_SESSION[$item][5];
            $obj6=$_SESSION[$item][6];
            $obj7=$_SESSION[$item][7];
            $obj8=$_SESSION[$item][8];
            $obj9=$_SESSION[$item][9];

            $field = 'stdcode,peopleid,gender,fullname,birthdate,telephone,cid,majorid1,regis_type,regis_cat';
            $data="'$obj0','$obj1','$obj2','$obj3','$obj4','$obj5','$obj6','$obj7','$obj8','$obj9'";
            $sql = $db->insertData('tb_student',$field,$data,$cond=null);
    }
    fclose($objCSV);
    header('Location: ' . $_SERVER['PHP_SELF']);
 }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KPT REGIS V.1.0</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/layout.css" rel="stylesheet">
  </head>
  <body class="skin-green">
    <!-- Site wrapper -->
    <div class="wrapper">
      <?php include("nav.php"); ?>
      <?php include("menu_left.php"); ?>
      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <font size="5">
            <b>ระบบจัดการข้อมูล</b>
            <small>นักเรียน</small>
          </font>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
            <li class="active">นักเรียน</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
                <font size="4">เพิ่มนักเรียนทั้งกลุ่ม</font>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
                <div class="box-body">
                  <form class="form-inline" name="form1" method="post" enctype="multipart/form-data" action="?addcsv">
                      <div class="form-group">
                        <label for="exampleInputFile">เพิ่มนักเรียนรายกลุ่ม</label>
                        <input type="file" id="fileCSV" name="fileCSV">
                        <p class="help-block">ไฟล์ CSV ดาวน์โหลดตัวอย่างไฟล์ <a href="uploads/csv/student.csv">student.csv</a></p>
                      </div>
                      <br><button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-folder-open"></span> บันทึก CSV</button>
                  </form><hr>
                  <span>เพิ่มนักศึกษาจำนวน <?php echo $_SESSION['num']; ?> คน</span>
                </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include("footer.php"); ?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
