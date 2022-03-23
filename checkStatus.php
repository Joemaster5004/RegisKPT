<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    include 'lib/config.inc.php';

    //DB1_person
    $db = new MySqlConn;
    $db->connect();
   
    if(isset($_GET['id'])){
      $pid = filter_var($_GET['id']);

      $condition = "peopleid=".$pid;
      $sql = $db->selectOneData('tb_student','*',$condition);
      $_SESSION['fullname'] = $sql['fullname'];

      if($pid == $sql['peopleid']){
          $stdcode = $sql['stdcode'];
          $_SESSION['stdcode'] = $stdcode;

          $condition2 = "majorid=".$sql['majorid1'];
          $mj = $db->selectOneData('tb_major','*',$condition2);
          $_SESSION['major'] = $mj['majorname'];
      }else{
          echo "<script>alert('รหัสประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง'); window.location ='index.php';</script>";
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KPT REGIS.V.3.0</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <section class="content">
      <div class="container-fluid">

        <!-- =========================================================== -->
        <p class="text-center"><img src="images/vec.gif" width="100"><br> <b><font size="5">วิทยาลัยเทคนิคกำแพงเพชร</font></b><br>สถานะการดำเนินการ</p>

        <div class="row">
        <div class="col-md-4 col-sm-6 col-12"></div>
        <div class="col-md-4 col-sm-6 col-12">
         <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title text-center">ตรวจสอบสถานะ</h3>
              </div>
                <div class="card-body">
                  <?php
                    $cond = "stdcode=".$stdcode;
                    $sqlRegis = $db->selectOneData('tb_register','*',$cond);
                    $sqlPay = $db->selectOneData('tb_pay','*',$cond);

                      if($sqlRegis['status']==1){
                        $status1 = "<font color='orange' size='5'><i class='fa fa-hourglass'></i> รออนุมัติ";
                      }else if($sqlRegis['status']==2){
                        $status1 = "<font color='green' size='5'><i class='fa fa-check-circle'></i> สำเร็จ</font>";
                      }else if($sqlRegis['status']==3){
                        $status1 = "<font color='red' size='5'><i class='fa fa-exclamation-circle '></i> เกิดปัญหา!! กรุณาติดต่อวิทยาลัยฯ</font>";
                      }else{
                        $status1 = "<font color='red' size='5'><i class='fa fa-times-circle'></i> ยังไม่ดำเนินการ</font>";
                      }

                      if($sqlPay['status']==1){
                        $status2 = "<font color='orange' size='5'><i class='fa fa-hourglass'></i> รออนุมัติ";
                      }else if($sqlPay['status']==2){
                        $status2 = "<font color='green' size='5'><i class='fa fa-check-circle'></i> สำเร็จ</font>";
                      }else if($sqlPay['status']==3){
                        $status2 = "<font color='red' size='5'><i class='fa fa-exclamation-circle '></i> เกิดปัญหา!! กรุณาติดต่อวิทยาลัยฯ</font>";
                      }else{
                        $status2 = "<font color='red' size='5'><i class='fa fa-times-circle'></i> ยังไม่ดำเนินการ</font>";
                      }
                      echo "<center><font size='4' color='blue'>รหัสประจำตัวผู้สมัคร: ".$_SESSION['stdcode']."</font></center>";
                      echo "<center><font size='4'>".$_SESSION['fullname']."</font><br>";
                      echo "<center><font size='2'>".$_SESSION['major']."</font><hr>";
                      echo "ขึ้นทะเบียน<br>".$status1."<hr>";
                  ?>
                </div>
                <div class="card-footer">
                  <a href=""><button type="submit" onclick="confirmLogout(event);" class="btn btn-warning">CLOSE</button></a>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-4 col-sm-6 col-12"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="AdminLTE/plugins/jquery/jquery.min.js"></script>
<script src="AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  //ยืนยันออกจากระบบ
function confirmLogout(e) {
	e.preventDefault();
	var frm = e.target.form;
	swal({
		title: "คำเตือน!",
		text: "คุณต้องการออกจากระบบใช่หรือไม่ ?",
		icon: "warning",
		buttons: ['ยกเลิก','ตกลง'],
		dangerMode: true,
	}).then(function(isConfirm) {
		if (isConfirm) {			
			window.location.href = "index.php";
		} else {
			swal("ยกเลิก !" , "กลับสู่หน้าหลัก", "error");
		}
	})
}

</script>
</body>
</html>
