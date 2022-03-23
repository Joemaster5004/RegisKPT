<?php
session_start();
include("lib/class_db.inc.php");
include("date.php");

if($_SESSION["user"]==""){
  header('Location: ../index.php');
}

 //DB1_person
 $db = new MySqlConn;
 $db->connect();

 //navigation
 $res1 = $db->selectOneData('tb_student','count(*) as ac',$condition=null);

 if(isset($_GET['unlockPay'])){
    //Update Status
    $id = $_GET['unlockPay'];
    
    $delPay = $db->deleteData('tb_pay','stdcode='.$id);
    header('Location: ' . $_SERVER['PHP_SELF']);
  }else{
    //Don't Search
    $perpage = 150;
    if (isset($_GET['page'])) { 
      $page = $_GET['page']; 
    }else{ 
      $page = 1;
    }
    $start = ($page - 1) * $perpage;
    $condit='status = 3 ORDER BY id DESC limit '.$start.','.$perpage;
    $sql = $db->selectAllData('tb_pay','*',$condit); 
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
    <link rel="stylesheet" type="text/css" href="../css/balloon.css">
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
            <b>ระบบจัดการการลงทะเบียน</b>
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
                <font size="4">สรุปนักศึกษาที่มีปัญหาค้างในระบบ</font>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
                <div class="box-body">
                  <table id="example1" class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th width="100">รหัสประจำตัว</th>
                      <th width="120">รหัสประชาชน</th>
                      <th width="200">ชื่อ-สกุล</th>
                      <th width="350">แผนกวิชา1</th>
                      <th></th>
                    </tr>
                    <?php
                    	foreach ($sql as $row) {
                            $stdcode = $row['stdcode']; 
                            $condition = "stdcode=".$stdcode;
                            $res1 = $db->selectOneData('tb_student','*',$condition);
                            $majorid = $res1['majorid1'];
                            $condition2 = "majorid=".$majorid;
                            $res2 = $db->selectOneData('tb_major','*',$condition2);
                            $start++;
                    ?>
                    <tr>
                      <td><?php echo $start; ?></td>
                      <td><?php echo $row['stdcode']; ?></font</td>
                      <td><?php echo $row['peopleid']; ?></td>
                      <td><?php echo $res1['fullname']; ?></td>
                      <td><?php echo $res2['majorid'].' - '.$res2['majorname']; ?></td>
                      <td>
                        <?php
                        $stdcode2 = $row['stdcode'];
                        $condition2='stdcode='.$stdcode2;
                        $sql2 = $db->selectOneData('tb_pay','*',$condition2);
                          $img2 = $sql2['image'];
                          $status2 = $sql2['status'];
                        if($img2 != null){
                            if($status2 == 3){
                                echo "<a href='../student/uploads/pay/".$img2."' target='_blank'><button class='btn btn-block btn-danger btn-xs'><i class='fa fa-warning'></i> ปัญหาเครืองแบบ</button></a>";
                                echo "<center><font size='1px'>".$sql2['pay_date']."</font></center>";
                                
                            }
                        }
                        ?>
                      </td>
                      <td>
                       <?php
                        if($img2 != null){
                            if($status2 == 3){
                                echo "<div class='btn-group'>";
                                echo "<button class='btn btn-primary btn-xs dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
                                echo "<i class='fa fa-gear'></i> <span class='caret'></span>";
                                echo "</button>";
                                echo "<ul class='dropdown-menu'>";
                                echo "<li><a href='?unlockPay=".$row['stdcode']."'>ปลดล็อค</a></li>";
                                echo "</ul></div>";
                                
                            }
                        }
                        ?>   
                      </td>
                    </tr>
                  <?php } ?>
                  </table>
                </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php
                      $total_record = $res1['ac'];
                      $total_page=ceil($total_record/$perpage);
                ?>
             <!--Pagination-->
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="reportRegis.php?page=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <?php for($i=1;$i<=$total_page;$i++){ ?>
                    <li><a href="reportRegis.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li><a href="reportRegis.php?page=<?php echo $total_page;?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            </ul>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php include("footer.php"); ?>
    </div><!-- ./wrapper -->              

    <!--Modal Zone-->


    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->

  </body>
</html>
